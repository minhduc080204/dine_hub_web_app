export type OrderType = {
    user_id: number;
    address: string;
    total_price: number;
    subtotal_price: number;
    delivery_price: number;
    discount: number;
    payment_status: string;
    order_status: string;
    created_at: string;
    product_id: string[];
    note: string;
  };
  