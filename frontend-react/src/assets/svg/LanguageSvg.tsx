import * as React from "react"
import Svg, { Circle, Path } from "react-native-svg"

const LanguageSvg: React.FC = (): JSX.Element => {
    return (
        <Svg
            width={30}
            height={30}
            viewBox="0 0 24 24"
            aria-labelledby="languageIconTitle"
            stroke="#000"
            strokeLinecap="square"
            fill="none"
            color="#000"
        >
            <Circle cx={12} cy={12} r={10} />
            <Path
                strokeLinecap="round"
                d="M12 22c2.667-2.424 4-5.758 4-10s-1.333-7.576-4-10C9.333 4.424 8 7.758 8 12s1.333 7.576 4 10ZM2.5 9h19m-19 6h19"
            />
        </Svg>
    )
}

export default LanguageSvg
