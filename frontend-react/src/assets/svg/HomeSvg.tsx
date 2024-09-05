import * as React from 'react';
import Svg, {Path} from 'react-native-svg';

const HomeSvg: React.FC = (): JSX.Element => {
  return (
    <Svg width={24} height={24} fill='none'>
      <Path
        stroke='#fff'
        strokeLinecap='round'
        strokeLinejoin='round'
        strokeWidth={1.5}
        d='M5 21h14M5 21V8m14 13V8M2 10l10-8 10 8'
      />
    </Svg>
  );
};

export default HomeSvg;


