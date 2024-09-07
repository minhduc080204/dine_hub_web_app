import React, { useEffect, useState } from 'react';
import type { NativeStackScreenProps } from '@react-navigation/native-stack';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  FlatList,
  ScrollView,
} from 'react-native';

import { text } from '../text';
import { svg } from '../assets/svg';
import { theme } from '../constants';
import { components } from '../components';
import type { ProductType, RootStackParamList } from '../types';
import {
  useGetProductsQuery,
  useGetCategoriesQuery,
} from '../store/slices/apiSlice';

type Props = NativeStackScreenProps<RootStackParamList, 'Menulist'>;

const Menulist: React.FC<Props> = ({ route }): JSX.Element => {
  const { category } = route.params;

  const [loading, setLoading] = useState(false);

  const {
    data: productsData,
    error: productsError,
    isLoading: productsLoading,
  } = useGetProductsQuery();
  const {
    data: categoriesData,
    error: categoriesError,
    isLoading: categoriesLoading,
  } = useGetCategoriesQuery();

  const [search, setSearch] = useState('');

  const [selectedCategory, setSelectedCategory] = useState(category || '');
  const dishes = productsData instanceof Array ? productsData : [];
  const categories = categoriesData instanceof Array ? categoriesData : [];

  const [dishesByCategory, SetDishesByCategory] = useState<ProductType[]>([]);

  const getDishesByCategoryBase = ()=>{
    return dishes?.filter(dish => dish.category.includes(selectedCategory)) || [];
  }

  useEffect(() => {
    SetDishesByCategory(getDishesByCategoryBase);
  }, [selectedCategory, dishes]);

  const handleSearch = () => {
    const dishesByCategoryBase = getDishesByCategoryBase();
    if (search.trim() === "") {
      SetDishesByCategory(dishesByCategoryBase);
    } else {
      SetDishesByCategory(dishesByCategoryBase.filter(category =>
        category.name.toLowerCase().includes(search.toLowerCase())
      ));
    }
  }
  if (loading) {
    return <components.Loader />;
  }

  const renderStatusBar = () => {
    return <components.StatusBar />;
  };

  const renderHeader = () => {
    return <components.Header goBack={true} title='Menu' basket={true} />;
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
          marginBottom: 14,
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
              key={'serchdis_ic'}
              onPress={handleSearch}
            >
              <svg.SearchSvg />
            </TouchableOpacity>
          </View>
          <TextInput
            placeholder='Search ...'
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

  const renderCategories = () => {
    return (
      <FlatList
        data={categories}
        horizontal={true}
        decelerationRate={0}
        contentContainerStyle={{
          paddingLeft: 20,
          marginBottom: 20,
        }}
        style={{
          flexGrow: 0,
          minHeight: 50,
        }}
        showsHorizontalScrollIndicator={false}
        renderItem={({ item, index }) => {
          const last = index === categories.length - 1;
          return (
            <TouchableOpacity
              style={{
                paddingHorizontal: 20,
                paddingVertical: 10,
                backgroundColor: theme.colors.white,
                borderRadius: 10,
                marginRight: last ? 20 : 8,
                borderWidth: 1,
                borderColor:
                  selectedCategory === item.name
                    ? theme.colors.mainTurquoise
                    : theme.colors.white,
              }}
              onPress={() => {
                setSelectedCategory(item.name);
              }}
            >
              <text.H5
                style={{
                  color:
                    selectedCategory === item.name
                      ? theme.colors.mainTurquoise
                      : theme.colors.mainColor,
                }}
              >
                {item.name}
              </text.H5>
            </TouchableOpacity>
          );
        }}
      />
    );
  };

  const renderContent = () => {
    return (
      <ScrollView
        contentContainerStyle={{
          flexGrow: 1,
          paddingHorizontal: 20,
        }}
        showsVerticalScrollIndicator={false}
      >
        {dishesByCategory?.map((item, index, array) => {
          const lastItem = index === array.length - 1;
          return (
            <components.MenuListItem
              item={item}
              lastItem={lastItem}
              key={item.id}
            />
          );
        })}
      </ScrollView>
    );
  };

  const renderHomeIndicator = () => {
    return <components.HomeIndicator />;
  };

  return (
    <components.SmartView>
      {renderStatusBar()}
      {renderHeader()}
      {renderSearchBar()}
      {renderCategories()}
      {renderContent()}
      {renderHomeIndicator()}
    </components.SmartView>
  );
};

export default Menulist;
