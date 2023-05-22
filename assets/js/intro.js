const fadeOut = () => {

    const loaderContainer = document.querySelector(".ui-pre-loader-container");
    loaderContainer.classList.add('fade');

}

window.addEventListener('load', fadeOut);