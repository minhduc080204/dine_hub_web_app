import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react';
import {BASE_URL, AUTHORIZATION_TOKEN, ENDPOINTS} from '../../config';

import {
  ProductType,
  BannerType,
  CarouselType,
  TagType,
  CategoryType,
  PromocodeType,
  OrderType,
  BankInforType,
  MessageType,
} from '../../types';
import { getMessage } from '@reduxjs/toolkit/dist/actionCreatorInvariantMiddleware';

export const apiSlice = createApi({
  reducerPath: 'apiSlice',
  baseQuery: fetchBaseQuery({
    baseUrl: BASE_URL,
    prepareHeaders: (headers) => {
      // Thêm header 'authorization' và 'api-key'
      headers.set('authorization', `Bearer ${AUTHORIZATION_TOKEN}`);
      headers.set('api-key', AUTHORIZATION_TOKEN); // Sửa dòng này để thêm api-key
      return headers;
    },
  }),
  endpoints: (builder) => ({
    getProducts: builder.query<{products: ProductType[]}, void>({
      query: () => ENDPOINTS.get.products,
    }),
    getBanners: builder.query<{banners: BannerType[]}, void>({
      query: () => ENDPOINTS.get.banners,
    }),
    getCarousel: builder.query<{carousel: CarouselType[]}, void>({
      query: () => ENDPOINTS.get.carousel,
    }),
    getCategories: builder.query<{categories: CategoryType[]}, void>({
      query: () => ENDPOINTS.get.categories,
    }),
    getReviews: builder.query<{reviews: any[]}, void>({
      query: () => ENDPOINTS.get.reviews,
    }),
    getUsers: builder.query<{users: any[]}, void>({
      query: () => ENDPOINTS.get.users,
    }),
    getTags: builder.query<{tags: TagType[]}, void>({
      query: () => ENDPOINTS.get.tags,
    }),
    getPromocodes: builder.query<{promocodes: PromocodeType[]}, void>({
      query: () => ENDPOINTS.get.promocodes,
    }),
    getOrders: builder.query<OrderType[], number>({
      query: (orderId) => `${ENDPOINTS.get.orders}/${orderId}`,
    }),
    getBankInfor: builder.query<BankInforType, void>({
      query: () => ENDPOINTS.get.bankinfor,
    }),    
    // getMessage: builder.query<{messages: MessageType[]}, void>({
    //   query: () => ENDPOINTS.get.message,
    // }),    

    getMessage: builder.mutation<any, {userId: number}>({
      query: (userId) => ({
        url: ENDPOINTS.post.message,
        method: 'POST',
        body: userId,
      }),
    }),

    sendMessage: builder.mutation<{ id: number }, MessageType>({
      query: (message) => ({
        url: ENDPOINTS.post.sendmessage,
        method: 'POST',
        body: message,
      }),
    }),
    createOrder: builder.mutation<{ id: number }, OrderType>({
      query: (orderData) => ({
        url: ENDPOINTS.post.order,
        method: 'POST',
        body: orderData,
      }),
    }),
    checkDiscount: builder.mutation<any, {code: string}>({
      query: (code) => ({
        url: ENDPOINTS.post.discount,
        method: 'POST',
        body: code,
      }),
    }),
    
  }),
});

export const {
  useGetTagsQuery,
  useGetUsersQuery,
  useGetBannersQuery,
  useGetReviewsQuery,
  useGetProductsQuery,
  useGetCarouselQuery,
  useGetCategoriesQuery,
  useGetPromocodesQuery,
  useGetOrdersQuery,
  useGetBankInforQuery,
  useGetMessageMutation,
  useSendMessageMutation,
  useCreateOrderMutation,
  useCheckDiscountMutation,
} = apiSlice;

export default apiSlice.reducer;
