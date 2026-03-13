<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table >
                    <thead>
                        <tr style="text-align: center;background-color: #303833; color: white;">
                            <th style="padding: 10px; border: 1px solid #ddd;">Customer Name</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Address</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Phone</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Product</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Product Image</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
                        
                            

                        
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr style="text-align: center;">
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $order->user->name }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $order->receiver_address }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $order->receiver_phone }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $order->product->product_title }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                {{ $order->product->product_price }}
                            </td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                            
                                <img style="width: 100px;" src="{{ asset('products/'.$order->product->product_image  ) }}" >
                            </td>
                            
                            <td style="padding: 12px;">
                                {{ $order->status }}

                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
