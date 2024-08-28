export type OrderType = {
    name: string;
    email: string;
    phone_number: string;
    address: string;
    total_price: number;
    subtotal_price: number;
    delivery_price: number;
    discount: number;
    payment_status: string;
    order_status: string;
    created_at: string;
    product_id: number; // Đây là trường cần phải có trong OrderType
  };
  