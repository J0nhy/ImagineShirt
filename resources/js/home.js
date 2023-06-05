var image = document.querySelector('#baseTshirt');

function changeImage(colorCode, colorName) {
    image.src = '/tshirt_base/' + colorCode + '.png';
    cor = colorName;
    changeURL();
}
