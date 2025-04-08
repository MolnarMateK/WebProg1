const { useState } = React;

function Header() {
    return React.createElement("header", null, 
        React.createElement("h1", null, "React Alkalmazás")
    );
}

function Footer() {
    return React.createElement("footer", null, 
        React.createElement("p", null, "Készítette: Molnár Máté, Kollár Krisztina – NEPTUN: HV1WUV, FH4R6N")
    );
}

function Calculator() {
    const [num1, setNum1] = useState(0);
    const [num2, setNum2] = useState(0);
    const [result, setResult] = useState(0);

    return React.createElement("div", null, 
        React.createElement(Header),
        React.createElement("h2", null, "Számológép"),
        React.createElement("input", { type: "number", value: num1, onChange: e => setNum1(Number(e.target.value)) }),
        React.createElement("input", { type: "number", value: num2, onChange: e => setNum2(Number(e.target.value)) }),
        React.createElement("button", { onClick: () => setResult(num1 + num2) }, "Összeadás"),
        React.createElement("button", { onClick: () => setResult(num1 - num2) }, "Kivonás"),
        React.createElement("button", { onClick: () => setResult(num1 * num2) }, "Szorzás"),
        React.createElement("button", { onClick: () => setResult(num2 !== 0 ? num1 / num2 : "Hiba") }, "Osztás"),
        React.createElement("h3", null, `Eredmény: ${result}`),
        React.createElement(Footer)
    );
}

ReactDOM.createRoot(document.getElementById("root")).render(React.createElement(Calculator));
