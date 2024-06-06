//    public function store(StoreOrderRequest $request, Order $order)
//    {
//        $orderData = $request->all();
//        $products = $request->input('Products');
//        $productsJson = json_encode($products);
//        $orderData['Products'] = $productsJson;
//
//        foreach ($products as $productData) {
//            $product = Product::find($productData['product_id']);
//            if (!$product || $product->quantity < $productData['quantity']) {
//              return response()->json("Product with ID {$productData['product_id']} does not have enough quantity available.");
//            }
//        }
//
//        $newOrder = Order::create($orderData);
//
//        foreach ($products as $productData) {
//            OrderItem::create([
//                'order_id' => $newOrder->id,
//                'product_id' => $productData['product_id'],
//                'quantity' => $productData['quantity'],
//                'price' => $productData['price']
//            ]);
//
//            }
//
//
//            return response()->json([
//                'message' => 'Order created successfully',
//                'order' => new OrderResource($newOrder)
//            ], 201);
//
//}
