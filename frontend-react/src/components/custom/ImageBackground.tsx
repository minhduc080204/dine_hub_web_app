import React from 'react';
import {ImageSourcePropType} from 'react-native';
import {ImageBackground as RNImageBackground} from 'react-native';
import { ENDPOINTS } from '../../config';

type Props = {
  source?: {uri: string};
  style?: object;
  imageStyle?: object;
  resizeMode?: 'cover' | 'contain' | 'stretch';
  children?: React.ReactNode;
};

const ImageBackground: React.FC<Props> = ({
  children,
  source,
  resizeMode,
  style,
  imageStyle,
}): JSX.Element => {
  return (
    <RNImageBackground
      source={(ENDPOINTS.image+source?.uri) as ImageSourcePropType}
      style={style}
      imageStyle={imageStyle}
      // resizeMode={
      //   resizeMode === 'cover'
      //     ? FastImage.resizeMode.cover
      //     : resizeMode === 'contain'
      //     ? FastImage.resizeMode.contain
      //     : FastImage.resizeMode.stretch
      // }
    >
      {children}
    </RNImageBackground>
  );
};

export default ImageBackground;
