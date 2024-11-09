import React, { useContext, useEffect, useRef, useState } from 'react';
import {
    ScrollView,
    Text,
    TextInput,
    TextStyle,
    TouchableOpacity,
    View,
    ViewStyle
} from 'react-native';

import { Path, Svg } from 'react-native-svg';
import { svg } from '../../assets/svg';
import { components } from '../../components';
import Image from '../../components/custom/Image';
import { theme } from '../../constants';
import { AuthContext } from '../../context/AuthContext';
import { useAppNavigation } from '../../hooks';
import { useGetMessageMutation, useSendMessageMutation } from '../../store/slices/apiSlice';
import { MessageType } from '../../types';
import { homeIndicatorHeight } from '../../utils';
import Pusher from 'pusher-js';
import { t } from 'i18next';


const Chat: React.FC = (): JSX.Element => {
    const navigation = useAppNavigation();
    const scrollViewRef = useRef<ScrollView>(null);
    const { userInfor } = useContext(AuthContext);
    const [getMessage, { data, error, isLoading }] = useGetMessageMutation();

    const [message, setMessage] = useState("");
    const [messages, setMessages] = useState<MessageType[]>([]);

    const [sendMessage] = useSendMessageMutation();

    useEffect(() => {
        setTimeout(() => {
          scrollViewRef.current?.scrollToEnd({ animated: true });
        }, 1000);
      }, []);

    useEffect(() => {        
        const fetchMessages = async () => {
            try {
                const response: any = await getMessage({ userId: userInfor.id });
                if (response?.data) {
                    setMessages(response.data);                    
                }

            } catch (err) {
                console.error("Error fetching messages:", err);
            }
        };

        fetchMessages();
    }, [getMessage]);

    useEffect(() => {
        const pusher = new Pusher('905ea1087d251dc4a082', {
            cluster: 'ap1',
        });

        const channel = pusher.subscribe('chatroom' + userInfor.id);
        channel.bind('MessageSent', (data: any) => {
            if (data && data.message) {
                const mess: MessageType = { content: data.message, role: data.role, userId: userInfor.id }
                setMessages((prevMessages) => [...prevMessages, mess]);
                setTimeout(() => {
                    scrollViewRef.current?.scrollToEnd({ animated: true });
                  }, 1000);
            }
        });

        return () => {
            channel.unbind_all();
            channel.unsubscribe();
        };
    }, []);

    const handleSendMessage = async () => {        
        if (message.trim()) {
            const mess: MessageType = { userId: userInfor.id, content: message }
            setMessage("");
            try {
                await sendMessage(mess);                
                scrollViewRef.current?.scrollToEnd({ animated: true });
            } catch (error) {
                console.error("Error sending message:", error);
            }
        }
    }

    const renderStatusBar = () => {
        return <components.StatusBar />;
    };

    const renderHeader = () => {
        return (
            <components.Header
                goBack={true}
                title={t('yournamecoffee')}
                phone={true}
                bottomLine={true}
            />
        );
    };

    const renderContent = () => {
        if (isLoading) {
            return <components.Loader />;
        }
        return (
            <ScrollView
                ref={scrollViewRef}
                contentContainerStyle={{
                    flexGrow: 1,
                    justifyContent: 'flex-end',
                    paddingHorizontal: 10,
                    paddingVertical: 5,
                }}
                showsVerticalScrollIndicator={false}
            >
                {renderMessage()}
            </ScrollView>
        );
    };

    const renderMessage = () => {
        if (messages.length > 0) {
            return (messages.map((message, index) => {
                const boxStyle: ViewStyle = {
                    flexDirection: 'row',
                    gap: 10,
                    alignItems: 'flex-start',
                    alignSelf: message.role == 'admin' ? 'flex-start' : 'flex-end',
                    margin: 5,
                };
                // const clientTextStyle: TextStyle = {
                //     backgroundColor: theme.colors.mainTurquoise,
                //     borderTopEndRadius: 0,
                //     borderTopStartRadius: 25,
                //     color: theme.colors.white,
                // }
                // const bossTextStyle:TextStyle = {
                //     backgroundColor: '#E9F3F6',
                //     borderTopEndRadius: 25,
                //     borderTopStartRadius: 0,
                //     color: 'black',
                // }
                const textStyle: TextStyle = {
                    backgroundColor: message.role == 'admin' ? '#E9F3F6' : theme.colors.mainTurquoise,
                    borderRadius: 25,
                    borderTopEndRadius: message.role == 'admin' ? 25 : 0,
                    borderTopStartRadius: message.role == 'admin' ? 0 : 25,
                    paddingHorizontal: 15,
                    paddingVertical: 8,
                    maxWidth: 250,
                    fontSize: 19,
                    color: message.role == 'admin' ? 'black' : theme.colors.white,
                    ...theme.fonts.DMSans_500Medium,
                };
                return (
                    <View key={'message' + index} style={boxStyle}>
                        <Image
                            source={{ uri: message.role == 'admin' ? 'https://george-fx.github.io/dine-hub/10.jpg' : 'x' }}
                            style={{
                                width: message.role == 'admin' ? 40 : 0,
                                height: message.role == 'admin' ? 40 : 0,
                                borderRadius: 50,
                            }}
                        />
                        <Text style={textStyle}>{message.content}</Text>
                    </View>

                );
            }))
        }

        return null;
    };

    const SendSvg: React.FC = () => {
        return (
            <Svg
                width={50}
                height={50}
                fill="none"
                viewBox="0 0 24 24"
            >
                <Path
                    d="m6.998 10.247.435.76c.277.485.415.727.415.993s-.138.508-.415.992l-.435.761c-1.238 2.167-1.857 3.25-1.375 3.788.483.537 1.627.037 3.913-.963l6.276-2.746c1.795-.785 2.693-1.178 2.693-1.832 0-.654-.898-1.047-2.693-1.832L9.536 7.422c-2.286-1-3.43-1.5-3.913-.963-.482.537.137 1.62 1.375 3.788Z"
                    fill={message.trim() ? "#00B0B9" : "#000"}
                // strokeWidth={2}
                // strokeLinecap="round"
                // strokeLinejoin="round"
                />
            </Svg>
        )
    }

    const renderBottomTabBar = () => {
        const containerStyle: ViewStyle = {
            backgroundColor: theme.colors.white,
            flexDirection: 'row',
            gap: 7,
            paddingTop: 15,
            paddingBottom: 12,
            paddingHorizontal: 20,
            borderRadius: 10,
            justifyContent: 'space-between',
            alignItems: 'center',
            marginBottom: homeIndicatorHeight() === 0 ? 20 : 10,
        };

        return (
            <View style={containerStyle}>
                <TouchableOpacity
                    style={{
                        alignItems: 'center',
                        margin: 5,
                        borderRadius: 50,
                    }}
                    onPress={() => { }}
                >
                    <svg.PictureSvg />
                </TouchableOpacity>

                <TextInput
                    style={{
                        flexGrow: 1,
                        height: '80%',
                        flexDirection: 'row',
                        justifyContent: 'space-between',
                        fontSize: 16,
                        marginLeft: 4,
                        paddingLeft: 15,
                        color: theme.colors.mainColor,
                        ...theme.fonts.DMSans_400Regular,
                        backgroundColor: '#E9F3F6',
                        borderColor: '#DBE9F5',
                        borderRadius: 15,
                    }}
                    placeholder={t('chat_title')}
                    placeholderTextColor={'#A7AFB7'}
                    value={message}
                    onChangeText={(text) => setMessage(text)}
                />
                <TouchableOpacity
                    style={{
                        alignItems: 'center',
                        margin: 5,
                        borderRadius: 50,
                    }}
                    onPress={() => { handleSendMessage() }}
                >
                    <SendSvg />
                </TouchableOpacity>
            </View >
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
            {renderBottomTabBar()}
            {renderHomeIndicator()}
        </components.SmartView>
    );
};

export default Chat;