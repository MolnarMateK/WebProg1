// React és ReactDOM globális elérése
const React = window.React;
const ReactDOM = window.ReactDOM;
const { useState } = React;

// Fejléc komponens
function Header() {
    return React.createElement("header", null, 
        React.createElement("h1", null, "React Alkalmazás")
    );
}

// Lábjegyzet komponens
function Footer() {
    return React.createElement("footer", null, 
        React.createElement("p", null, "Készítette: Molnár Máté, Kollár Krisztina  – NEPTUN: HV1WUV, FH4R6N")
    );
}

// Számláló komponens
function Counter() {
    const [count, setCount] = useState(0);

    return React.createElement("div", { style: { textAlign: "center", padding: "20px" } }, 
        React.createElement(Header),
        React.createElement("h2", null, "Számláló"),
        React.createElement("h3", null, count),
        React.createElement("button", { onClick: () => setCount(count + 1) }, "Növel"),
        React.createElement("button", { onClick: () => setCount(count - 1) }, "Csökkent"),
        React.createElement("button", { onClick: () => setCount(0) }, "Nulláz"),
        React.createElement(Footer)
    );
}

// Gyökérelem renderelése (stabilabb módszer)
ReactDOM.render(
    React.createElement(Counter),
    document.getElementById("root")
);
