import React, { PropsWithChildren, useContext } from 'react';
import { View, Text, ScrollView } from 'react-native';

import { text } from '../text';
import { theme } from '../constants';
import { components } from '../components';
import { useAppNavigation } from '../hooks';
import { NativeStackScreenProps } from '@react-navigation/native-stack';
import { RootStackParamList } from '../types';
import { AuthContext } from '../context/AuthContext';
import { useGetOrdersQuery } from '../store/slices/apiSlice';
import { OrderType } from '../types/OrderType';

type Props = NativeStackScreenProps<RootStackParamList, 'TrackYourOrder'>;

const TrackYourOrder: React.FC<Props> = ({ route }): JSX.Element => {
  const { userInfor } = useContext(AuthContext)
  const { data: orders, error, isLoading } = useGetOrdersQuery(userInfor.id);
  const { orderId } = route.params;
  const order = orders?.find((o: any) => o.id === orderId)

  const date = order?.created_at;
  const address = order?.address;
  const status = order?.order_status;
  const navigation = useAppNavigation();

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return <components.Header goBack={true} title='Track your order' />;
  };

  const renderDescription = () => {
    return (
      <View
        style={{
          borderWidth: 1,
          borderColor: theme.colors.mainTurquoise,
          borderRadius: 10,
          marginHorizontal: 20,
          padding: 20,
          marginBottom: 10,
        }}
      >
        <View
          style={{ flexDirection: 'row', alignItems: 'center', marginBottom: 14 }}
        >
          <text.T14 style={{ marginRight: 14, textTransform: 'none' }}>
            Date:
          </text.T14>
          <text.H5 style={{ color: theme.colors.mainTurquoise }}>{date}</text.H5>
        </View>
        <View style={{ flexDirection: 'row', alignItems: 'center' }}>
          <text.T14 style={{ marginRight: 14, textTransform: 'none' }}>
            Address:
          </text.T14>
          <text.H5 style={{ color: theme.colors.mainTurquoise }}>
            {address}
          </text.H5>
        </View>
      </View>
    );
  };

  const renderOrderStatus = () => {
    const order_status = [
      {
        id: "Delivered",
        title: "Done",
        description: 'Your order has been delivered',
      },
      {
        id: "Shipping",
        title: 'Order is being shipped',
        description: 'Estimated for 9:12 pm',
      },
      {
        id: "Confirm",
        title: 'Order confirmed',
        description: 'Estimated for 9:12 pm',
      },
      {
        id: "Processing",
        title: 'Processing',
        description: 'Estimated for 9:32 pm',
      },
    ]
    let checkStatus = false;
    return (
      <View
        style={{
          backgroundColor: theme.colors.white,
          marginHorizontal: 20,
          borderRadius: 10,
          padding: 30,
        }}
      >
        {order_status.map((os) => {
          status == os.id ? checkStatus = true : ""
          return (
            <components.OrderStatus
              key={os.id}
              title={os.title}
              description={checkStatus ? os.description : "Waiting"}
              status={checkStatus}
              containerStyle={{ marginBottom: 7 }}
            />
          )
        })}
      </View>
    );
  };

  const renderContent = () => {
    return (
      <ScrollView
        contentContainerStyle={{ flexGrow: 1, paddingTop: 10 }}
        showsVerticalScrollIndicator={false}
      >
        {renderDescription()}
        {renderOrderStatus()}
      </ScrollView>
    );
  };

  const renderButton = (title: string = 'Chat support', danger: boolean = false) => {
    return (
      <View style={{ paddingHorizontal: 20, paddingBottom: 10, paddingTop: 5 }}>
        <components.Button title={title} danger={danger} onPress={() => { }} />
      </View>
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
      {renderButton()}
      {status == "Processing" && (
        renderButton('UnOrder', true)
      )}

      {renderHomeIndicator()}
    </components.SmartView>
  );
};

export default TrackYourOrder;
