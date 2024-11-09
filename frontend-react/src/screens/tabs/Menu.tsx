import React, { useEffect, useState } from 'react';
import {
  View,
  TextInput,
  ScrollView,
  ViewStyle,
  ImageStyle,
  TextStyle,
  TouchableOpacity,
} from 'react-native';

import { text } from '../../text';
import { svg } from '../../assets/svg';
import { sizes } from '../../constants';
import { theme } from '../../constants';
import { components } from '../../components';
import { useAppNavigation } from '../../hooks';
import BottomTabBar from '../../navigation/BottomTabBar';
import {
  useGetCategoriesQuery,
  useGetProductsQuery,
} from '../../store/slices/apiSlice';
import { CategoryType } from '../../types';
import { BASE_URL_IMG } from '../../config';
import { useTranslation } from 'react-i18next';

const Menu: React.FC = (): JSX.Element => {
  const navigation = useAppNavigation();
  const { t } = useTranslation();

  const {
    data: categoryData,
    error: categoryError,
    isLoading: categoryLoading,
  } = useGetCategoriesQuery();

  const {
    data: productsData,
    error: productsError,
    isLoading: productsLoading,
  } = useGetProductsQuery();

  const categoriesBase = categoryData instanceof Array ? categoryData : [];
  const [categories, setCategories] = useState<CategoryType[]>([...categoriesBase]);

  const dishes = productsData instanceof Array ? productsData : [];


  const [search, setSearch] = useState('');

  const handleSearch = () => {
    if(search.trim()===""){
      setCategories([...categoriesBase])
    }else{
      setCategories(categoriesBase.filter(category =>
        category.name.toLowerCase().includes(search.toLowerCase())
      ));
    }
  }

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return (
      <components.Header
        basket={true}
        user={true}
        userImage={true}
        userName={true}
      />
    );
  };

  const renderSearchBar = () => {
    return (
      <View
        style={{
          marginTop: 10,
          flexDirection: 'row',
          alignItems: 'center',
          justifyContent: 'space-between',
          marginHorizontal: 20,
          height: 50,
        }}
      >
        <View
          style={{
            backgroundColor: theme.colors.white,
            flex: 1,
            borderRadius: 10,
            marginRight: 5,
            padding: 5,
            flexDirection: 'row',
            alignItems: 'center',
            height: '100%',
          }}
        >
          <View
            style={{
              backgroundColor: theme.colors.mainTurquoise,
              width: 40,
              height: '100%',
              borderRadius: 8,
              justifyContent: 'center',
              alignItems: 'center',
              marginRight: 14,
            }}

          >
            <TouchableOpacity
              key={'serch_ic'}
              onPress={handleSearch}
            >
              <svg.SearchSvg />
            </TouchableOpacity>
          </View>
          <TextInput
            placeholder={t('search')}
            value={search}
            onChangeText={(text) => { setSearch(text) }}
            style={{
              flex: 1,
              ...theme.fonts.DMSans_400Regular,
              fontSize: 16,
              color: theme.colors.mainColor,
            }}
            placeholderTextColor={theme.colors.textColor}
          />
        </View>
        {/* <TouchableOpacity
          style={{
            backgroundColor: theme.colors.white,
            borderRadius: 10,
            height: 50,
            width: 50,
            justifyContent: 'center',
            alignItems: 'center',
          }}
        >
          <svg.FilterSvg />
        </TouchableOpacity> */}
      </View>
    );
  };

  const renderContent = () => {
    if (categoryLoading || productsLoading) {
      return <components.Loader />;
    }

    const blockWidth = sizes.width / 2 - 27.7;

    const scrollViewStyle: ViewStyle = {
      flexGrow: 1,
      paddingTop: 20,
      paddingHorizontal: 20,
      paddingBottom: 20,
      flexDirection: 'row',
      justifyContent: 'space-between',
      flexWrap: 'wrap',
    };

    const touchableOpacityStyle: ViewStyle = {
      width: blockWidth,
      height: blockWidth,
      marginBottom: 15,
      backgroundColor: theme.colors.white,
      borderRadius: 10,
    };

    const imageBackgroundStyle: ImageStyle = {
      width: blockWidth,
      height: blockWidth,
      paddingHorizontal: 20,
      paddingVertical: 10,
      justifyContent: 'flex-end',
    };

    const textStyle: TextStyle = {
      color: theme.colors.mainColor,
      textTransform: 'capitalize',
    };

    return (
      <ScrollView contentContainerStyle={{ ...scrollViewStyle }}>
        {categories.map((item, index) => {
          return (
            <TouchableOpacity
              key={item.id}
              style={{ ...touchableOpacityStyle }}
              onPress={() => {
                navigation.navigate('Menulist', {
                  category: item.name,
                });
              }}
            >
              <components.ImageBackground
                source={{ uri: BASE_URL_IMG+item.image }}
                imageStyle={{ borderRadius: 10 }}
                style={{ ...imageBackgroundStyle }}
                resizeMode='cover'
              >
                <text.T16 numberOfLines={1} style={{ ...textStyle }}>
                  {item.name}
                </text.T16>
              </components.ImageBackground>
            </TouchableOpacity>
          );
        })}
      </ScrollView>
    );
  };

  const renderBottomTabBar = () => {
    return <BottomTabBar />;
  };

  const renderHomeIndicator = () => {
    return <components.HomeIndicator />;
  };

  return (
    <components.SmartView>
      {renderStatusBar()}
      {renderHeader()}
      {renderSearchBar()}
      {renderContent()}
      {renderBottomTabBar()}
      {renderHomeIndicator()}
    </components.SmartView>
  );
};

export default Menu;
