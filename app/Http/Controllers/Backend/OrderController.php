<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AnswerRequest;
use App\Http\Requests\Frontend\OrderListRequest;
use App\Order;
use App\UseCases\Order\CreateOrderService;
use App\UseCases\Order\Message\CreateOrderMessageService;
use App\UseCases\Order\UpdateStatusOrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var CreateOrderMessageService
     */
    private $createOrderMessageService;
    /**
     * @var CreateOrderService
     */
    private $createOrderService;
    /**
     * @var UpdateStatusOrderService
     */
    private $updateStatusOrderService;

    public function __construct(
        CreateOrderMessageService $createOrderMessageService,
        UpdateStatusOrderService $updateStatusOrderService
    ) {
        $this->createOrderMessageService = $createOrderMessageService;
        $this->updateStatusOrderService = $updateStatusOrderService;
    }

    public function index(OrderListRequest $request)
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->when($request->get('status', null), static function($query, $status){
                return $query->where('status', $status);
            })
            ->paginate();

        return view(
            'web.backend.sections.orders.index',
            [
                'orders' => $orders->appends($request->validated()),
                'availableStatuses'=>Order::getAvailableStatuses()
            ]
        );
    }

    public function show(Order $order)
    {
//        $order->update(['is_read' => true, 'has_answer' => false]);
        return view('web.backend.sections.orders.show', compact('order'));
    }

    public function answer(AnswerRequest $request, Order $order)
    {
        try {
            $this->createOrderMessageService->create($order->id, Auth::user()->id, $request->validated());
            return redirect()->back()->with('success', 'Message added');
        } catch (\Throwable $e) {
            return redirect()->back()->with(
                'error',
                'Message not added. Try again later!'
                . $this->addDevExceptionMessage($e)
            );
        }
    }

    private function addDevExceptionMessage($e)
    {
        dd($e);
        return config('app.env') === 'local' ? ' ' . $e->getMessage() : '';
    }

    public function close(Order $order)
    {
        try {
            $this->updateStatusOrderService->close($order->id);

            return redirect()->back()->with('success', 'Order closed');
        } catch (\Throwable $e) {
            return redirect()->back()->with(
                'error',
                'Order not closed. Try again later!'
                . $this->addDevExceptionMessage($e)
            );
        }
    }
    public function approve(Order $order)
    {
        try {
            $this->updateStatusOrderService->approve($order->id);

            return redirect()->back()->with('success', 'Order approved');
        } catch (\Throwable $e) {
            return redirect()->back()->with(
                'error',
                'Order not approved. Try again later!'
                . $this->addDevExceptionMessage($e)
            );
        }
    }
}
