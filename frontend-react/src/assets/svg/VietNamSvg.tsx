import * as React from "react"
import Svg, { Circle, Path } from "react-native-svg"

const VietNamSvg: React.FC = (): JSX.Element => {
    return (
        <Svg
            width={30}
            height={30}
            viewBox="0 0 64 64"
        >
            <Circle cx={32} cy={32} r={30} fill="#f42f4c" />
            <Path
                fill="#ffe62e"
                d="m32 39 9.9 7-3.7-11.4 9.8-7.4H35.8L32 16l-3.7 11.2H16l9.8 7.4L22.1 46z"
            />
        </Svg>
    )
}

export default VietNamSvg
