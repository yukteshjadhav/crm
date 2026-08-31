<?php

namespace App\Http\Controllers\Employee\Payment;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index(Request $request)
    {
        $query = Payments::with(['order', 'lead']);

        if ($request->has('order_id')) {
            $query->where('order_id', $request->order_id);
        }

        if ($request->has('lead_id')) {
            $query->where('lead_id', $request->lead_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('employee.payments.index', compact('payments'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'order_id' => 'required|exists:orders,id',
                'amount' => 'required|numeric|min:0.01',
                'payment_method' => 'required|in:cash,upi,bank_transfer,credit_card,debit_card,cheque,online',
                'payment_date' => 'nullable|date',
                'reference_id' => 'nullable|string|max:100',
                'status' => 'required|in:pending,paid,failed,refunded,partial',
                'notes' => 'nullable|string',
                'bank_name' => 'nullable|string|max:100',
                'cheque_number' => 'nullable|string|max:50',
                'cheque_date' => 'nullable|date',
            ]);

            $order = Orders::findOrFail($validated['order_id']);

            // Create payment
            $payment = Payments::create([
                'order_id' => $validated['order_id'],
                // 'lead_id' => $order->lead_id,
                'amount' => $validated['amount'],
                'payment_mode' => $validated['payment_method'],
                'payment_status' => $validated['status'],
                'transaction_reference' => $validated['reference_id'] ?? null,
                'payment_date' => $validated['payment_date'] ?? now(),
                'notes' => $validated['notes'] ?? null,
                'received_by'   => Auth::id()
                // 'bank_name' => $validated['bank_name'] ?? null,
                // 'cheque_number' => $validated['cheque_number'] ?? null,
                // 'cheque_date' => $validated['cheque_date'] ?? null,
            ]);

            // If payment is successful, update order status if fully paid
            if ($validated['status'] == 'paid' || $validated['status'] == 'partial') {
                $totalPaid = $order->payments()->whereIn('payment_status', ['paid', 'partial'])->sum('amount');
                $order->payment_status = $validated['status'];
                $order->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Payment added successfully!',
                'payment' => $payment->load(['order'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to add payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified payment.
     */
    public function show(Payments $payment)
    {
        $payment->load(['order', 'lead']);
        return view('employee.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment.
     */
    public function edit(Payments $payment)
    {
        $payment->load(['order', 'lead']);
        return view('employee.payments.edit', compact('payment'));
    }

    /**
     * Update the specified payment.
     */
    public function update(Request $request, Payments $payment)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'amount' => 'sometimes|numeric|min:0.01',
                'payment_method' => 'sometimes|in:cash,upi,bank_transfer,credit_card,debit_card,cheque,online',
                'payment_date' => 'nullable|date',
                'reference_id' => 'nullable|string|max:100',
                'status' => 'sometimes|in:pending,paid,failed,refunded,partial',
                'notes' => 'nullable|string',
                'bank_name' => 'nullable|string|max:100',
                'cheque_number' => 'nullable|string|max:50',
                'cheque_date' => 'nullable|date',
            ]);

            $payment->update($validated);

            // Update order status if payment status changed
            if (isset($validated['status'])) {
                $order = $payment->order;
                $totalPaid = $order->payments()->whereIn('payment_status', ['paid', 'partial'])->sum('amount');

                if ($validated['status'] == 'paid' || $validated['status'] == 'partial') {
                    $totalPaid = $order->payments()->whereIn('payment_status', ['paid', 'partial'])->sum('amount');
                    $order->payment_status = $validated['status'];
                    $order->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Payment updated successfully!',
                'payment' => $payment->load(['order'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified payment.
     */
    public function destroy(Payments $payment)
    {
        try {
            DB::beginTransaction();

            $order = $payment->order;
            $payment->delete();

            // Update order status after payment deletion
            $totalPaid = $order->payments()->whereIn('status', ['paid', 'partial'])->sum('amount');

            if ($totalPaid >= $order->total_amount) {
                $order->status = 'confirmed';
                $order->save();
            } elseif ($totalPaid > 0 && $totalPaid < $order->total_amount) {
                $order->status = 'pending';
                $order->save();
            } else {
                $order->status = 'pending';
                $order->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Payment deleted successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payments summary for a specific order.
     */
    public function getOrderPayments(Orders $order)
    {
        $payments = $order->payments()->orderBy('created_at', 'desc')->get();
        $totalPaid = $payments->sum('amount');
        $balance = $order->total_amount - $totalPaid;

        return response()->json([
            'success' => true,
            'data' => [
                'payments' => $payments,
                'total_paid' => $totalPaid,
                'balance' => $balance,
                'order_total' => $order->total_amount
            ]
        ]);
    }

    /**
     * Get payments summary for a specific lead.
     */
    public function getLeadPayments($leadId)
    {
        $payments = Payments::with(['order'])
            ->where('lead_id', $leadId)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPaid = $payments->sum('amount');

        return response()->json([
            'success' => true,
            'data' => [
                'payments' => $payments,
                'total_paid' => $totalPaid,
                'count' => $payments->count()
            ]
        ]);
    }

    /**
     * Export payments to CSV/Excel.
     */
    public function export(Request $request)
    {
        $query = Payments::with(['order', 'lead']);

        if ($request->has('order_id')) {
            $query->where('order_id', $request->order_id);
        }

        if ($request->has('lead_id')) {
            $query->where('lead_id', $request->lead_id);
        }

        if ($request->has('date_from')) {
            $query->whereDate('payment_date', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('payment_date', '<=', $request->date_to);
        }

        $payments = $query->get();

        // Generate CSV
        $filename = 'payments_export_' . date('Y-m-d_H-i-s') . '.csv';
        $handle = fopen('php://temp', 'r+');

        // Add headers
        fputcsv($handle, [
            'Payment ID',
            'Order ID',
            'Lead ID',
            'Lead Name',
            'Amount',
            'Method',
            'Date',
            'Reference',
            'Status',
            'Created At'
        ]);

        // Add data
        foreach ($payments as $payment) {
            fputcsv($handle, [
                $payment->id,
                $payment->order_id,
                $payment->lead_id,
                $payment->lead->full_name ?? 'N/A',
                $payment->amount,
                $payment->payment_method,
                $payment->payment_date,
                $payment->reference_id,
                $payment->status,
                $payment->created_at
            ]);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return response($csvContent, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
