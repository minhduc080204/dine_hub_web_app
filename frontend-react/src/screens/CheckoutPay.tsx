import type { NativeStackScreenProps } from '@react-navigation/native-stack';
import React, { useContext, useState } from 'react';
import { Text, TouchableOpacity, View } from 'react-native';

import { svg } from '../assets/svg';
import { components } from '../components';
import Image from '../components/custom/Image';
import { theme } from '../constants';
import { AuthContext } from '../context/AuthContext';
import { useAppDispatch, useAppNavigation, useAppSelector } from '../hooks';
import { useCreateOrderMutation, useGetBankInforQuery } from '../store/slices/apiSlice';
import { resetCart } from '../store/slices/cartSlice';
import { text } from '../text';
import type { BankInforType, RootStackParamList } from '../types';
import { OrderType } from '../types/OrderType';
import { t } from 'i18next';

type Props = NativeStackScreenProps<RootStackParamList, 'CheckoutPay'>;

const Checkout: React.FC<Props> = ({ route }): JSX.Element => {
  const dispatch = useAppDispatch();
  const { total, subtotal, delivery, discount, address, note } = route.params;
  const navigation = useAppNavigation();
  const [loading, setLoading] = useState(false);
  const cart = useAppSelector((state) => state.cartSlice.list);

  const [createOrder, { data, error, isLoading }] = useCreateOrderMutation();
  const { userInfor } = useContext(AuthContext);

  const {
    data: bankData,
    error: bankError,
    isLoading: bankLoading,
  } = useGetBankInforQuery();

  const bankInfor: BankInforType = {
    id: bankData?.id,
    bank_id: bankData?.bank_id,
    bank_name: bankData?.bank_name,
    number: bankData?.number,
    name: bankData?.name,
    price: total,
    note: Date.now().toString(),
  }

  const handlePayed = async () => {
    try {
      setLoading(true);
      const product_id = cart.map((cart) => cart.id);
      const OrderData: OrderType = {
        id: 1,
        user_id: userInfor.id,
        address: address,
        total_price: Number(total),
        subtotal_price: Number(subtotal),
        delivery_price: Number(delivery),
        discount: Number(discount),
        payment_status: 'Paid',
        order_status: 'Processing',
        created_at: new Date().toISOString(),
        product_id: product_id,
        note: note,
      };
      let res: any = await createOrder(OrderData);
      if (!res || !res.data) {
        navigation.navigate('OrderFailed');
        setLoading(false);
        return;
      }
    } catch (err) {
      navigation.navigate('OrderFailed');
      console.log(err);
    }
    dispatch(resetCart());
    setLoading(false);
    navigation.navigate('OrderSuccessful');
  };

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return <components.Header goBack={true} title='Payment' />;
  };

  const renderOrderSummary = () => {
    return (
      <View
        style={{
          padding: 20,
          borderWidth: 1,
          borderRadius: 10,
          borderColor: theme.colors.mainTurquoise,
          marginBottom: 30,
        }}
      >
        <View
          style={{
            flexDirection: 'row',
            alignItems: 'center',
            justifyContent: 'space-between',
            borderBottomWidth: 1,
            borderBottomColor: '#DBE9F5',
            paddingBottom: 20,
            marginBottom: 20,
          }}
        >
          <text.H4>{t('amount_pay')}</text.H4>
          <text.H4>${total}</text.H4>
        </View>
        {cart.map((item, index) => {
          return (
            <View
              key={index}
              style={{
                flexDirection: 'row',
                alignItems: 'center',
                justifyContent: 'space-between',
                marginBottom: 10,
              }}
            >
              <text.T14>{item.name}</text.T14>
              <text.T14>
                {item.quantity} x ${item.price}
              </text.T14>
            </View>
          );
        })}
        {discount > 0 && (
          <View
            style={{
              flexDirection: 'row',
              alignItems: 'center',
              justifyContent: 'space-between',
              marginBottom: 10,
            }}
          >
            <text.T14>Discount</text.T14>
            <text.T14>- ${discount.toFixed(2)}</text.T14>
          </View>
        )}
        <View
          style={{
            flexDirection: 'row',
            alignItems: 'center',
            justifyContent: 'space-between',
          }}
        >
          <text.T14>{t('delivery')}</text.T14>
          <text.T14>${delivery}</text.T14>
        </View>
      </View>
    );
  };

  const renderQRInfor = () => {
    const qrcode_url = `https://img.vietqr.io/image/${bankInfor.bank_id}-${bankInfor.number}-compact.png?amount=${bankInfor.price}&addInfo=${bankInfor.note?.split("").join("%20")}&accountName=${bankInfor.name?.split(" ").join("%20")}`;
    return (
      <View
        style={{
          padding: 20,
          borderWidth: 1,
          borderRadius: 10,
          borderColor: theme.colors.mainTurquoise,
          marginBottom: 30,
          alignItems: 'center', // Căn giữa theo chiều ngang
          justifyContent: 'center', // Căn giữa theo chiều dọc
        }}
      >
        <View
          style={{
            flexDirection: 'row',
            alignItems: 'center',
            justifyContent: 'space-between',
            borderBottomWidth: 1,
            borderBottomColor: '#DBE9F5',
            paddingBottom: 20,
            marginBottom: 20,
          }}
        >
          <text.H4 style={{ textAlign: 'center', width: '100%' }}>
          {t('payment_title')}
          </text.H4>
        </View>
        {!bankLoading?
          <>
            <View
              style={{
                flexDirection: 'row',
                alignItems: 'center',
                justifyContent: 'space-between',
                width: 300,
              }}
            >
              <Image
                source={{ uri: qrcode_url }}
                style={{ width: 300, aspectRatio: 1, alignSelf: 'center' }}
                resizeMode='cover'
              />
            </View>
            <View
              style={{
                flexDirection: 'column',
                alignItems: 'center',
                justifyContent: 'space-between',
                borderBottomWidth: 1,
                borderBottomColor: '#DBE9F5',
                paddingBottom: 20,
                // marginBottom: 20,
                marginTop: 20,
                gap: 10,
              }}
            >
              <text.H3>{bankInfor.bank_name}</text.H3>
              <text.H3>{bankInfor.number}</text.H3>
              <text.H3>{bankInfor.name}</text.H3>
              {/* <text.H4>Tên NH: {bankInfor.bank_name}</text.H4>
              <text.H4>STK: {bankInfor.number}</text.H4>
              <text.H4>Tên: {bankInfor.name}</text.H4> */}
            </View>
          </> : <components.Loader />
        }


      </View>
    );
  };

  const renderShippingDetails = () => {
    return (
      <TouchableOpacity
        style={{
          padding: 20,
          backgroundColor: theme.colors.white,
          borderRadius: 10,
          marginBottom: 14,
          flexDirection: 'row',
          alignItems: 'center',
          justifyContent: 'space-between',
        }}
        onPress={() => { }}
      >
        <View>
          <Text
            style={{
              ...theme.fonts.DMSans_500Medium,
              fontSize: 14,
              textTransform: 'capitalize',
              color: theme.colors.mainColor,
              marginBottom: 10,
            }}
          >
            {t('address_title')}
          </Text>
          <Text
            style={{
              ...theme.fonts.DMSans_400Regular,
              color: theme.colors.textColor,
              fontSize: 12,
              lineHeight: 12 * 1.5,
            }}
          >
            {address}
          </Text>
        </View>
        <svg.ArrowRightSvg />
      </TouchableOpacity>
    );
  };

  const renderButton = () => {
    return (
      <View
        style={{
          flexDirection: 'row',
          alignItems: 'center',
          justifyContent: 'space-between',
          // position: 'absolute',  // Giữ vị trí cố định
          // bottom: 0,
          // position: 'absolute', left: 0, right: 0, bottom: 0,
          padding: 20,
        }}

      >
        <components.Button
          title={t('unpay')}
          danger={true}
          loading={loading}
          containerStyle={{
            width: '48%',
          }}
          onPress={() => {
            navigation.goBack()
          }}
        />
        <components.Button
          title={t('payed')}
          loading={loading}
          containerStyle={{
            width: '48%',
          }}
          onPress={() => {
            handlePayed()
          }}
        />
      </View>
    )
  }

  const renderContent = () => {
    const contentContainerStyle = {
      flexGrow: 1,
      paddingTop: 10,
      paddingBottom: 20,
      paddingHorizontal: 20,
    };

    return (
      <components.KAScrollView
        contentContainerStyle={{ ...contentContainerStyle }}
      >
        {renderQRInfor()}
        {renderOrderSummary()}
        {renderShippingDetails()}
        {renderButton()}
      </components.KAScrollView>
    );
  };

  const renderHomeIndicator = () => {
    return <components.HomeIndicator />;
  };

  return (
    <components.SmartView>
      {renderStatusBar()}
      {renderHeader()}
      {renderContent()}
      {renderHomeIndicator()}
    </components.SmartView>
  );
};

export default Checkout;
