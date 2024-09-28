export const ENDPOINTS = {
  image: 'http://127.0.0.1:8000/storage/images/',
  get: {
    tags: 'api/tags',
    users: 'api/users',//
    orders: 'api/orders',//
    carousel: 'api/slides',
    banners: 'api/banners',
    reviews: 'api/reviews',
    discount: 'api/discount',
    products: 'api/products',//
    promocode: 'api/promocode',
    promocodes: 'api/promocodes',
    categories: 'api/categories',//
    bankinfor: 'api/bank',    
  },
  chat: 'admin/chat',
  post: {
    order: 'api/order/create',
    discount: 'api/checkdiscount',
    message: 'api/message',
    sendmessage: 'api/sendmessage',
  },
  auth: {
    login: 'api/auth/login',
    register: 'api/auth/register',
    updateUser: 'api/auth/user/update',
    emailVerify: 'api/auth/email/verify',
    createNewUser: 'api/auth/user/create',
    ifUserExists: 'api/auth/user/exists',
    ifEmailExists: 'api/auth/email/exists',
    emailConfirm: 'api/auth/email/confirm',
  },
};
