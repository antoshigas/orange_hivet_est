(function () {

    const cards = document.querySelectorAll(".card");
    cards.forEach((card) => {
        card.onclick = () => {
            window.location.href = window.location.href.slice(0, -1) + '/' + card.id;
        };
    });

})();