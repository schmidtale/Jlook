// ===================================================
// Booking Modal Functions
// ===================================================
let currentTourPrice = 0;

function openBookingModal(id, name, city, price, imageSrc) {
    currentTourPrice = parseInt(price); 

    document.getElementById('modalTourId').value = id;
    document.getElementById('modalTourName').innerText = name;
    document.getElementById('modalTourCity').innerText = city;
    document.getElementById('modalTourImage').src = imageSrc;
    document.getElementById('modalBasePriceNum').innerText = currentTourPrice.toLocaleString();

    document.getElementById('bookingGuests').value = "1";
    document.getElementById('bookingDate').value = "";
    
    calculateTotalPrice();

    const modal = document.getElementById('bookingModal');
    if (modal) {
        modal.classList.add('active');
    }
}

function closeBookingModal() {
    const modal = document.getElementById('bookingModal');
    if (modal) {
        modal.classList.remove('active');
    }
}

function calculateTotalPrice() {
    const guestsInput = document.getElementById('bookingGuests');
    if (!guestsInput) return;
    
    const guestsCount = parseInt(guestsInput.value) || 1;
    const totalPrice = currentTourPrice * guestsCount;
    
    document.getElementById('modalTotalPrice').innerText = '¥' + totalPrice.toLocaleString();
}

window.onclick = function(event) {
    const modal = document.getElementById('bookingModal');
    if (event.target === modal) {
        closeBookingModal();
    }
};

// ===================================================
// Filter & Search Functionality
// ===================================================
document.addEventListener("DOMContentLoaded", () => {

    const search = document.getElementById("searchTour");
    const sort = document.getElementById("sortTour");
    const cityFilters = document.querySelectorAll(".city-filter");
    const priceSlider = document.querySelector(".filter-group input[type='range']");
    const priceText = document.querySelector(".filter-group span");
    const grid = document.querySelector(".tour-grid");
    const noResult = document.getElementById("noResult");

    if (!grid) return;

    function updateNoResult() {
        let visible = 0;
        document.querySelectorAll(".tour-card").forEach(card => {
            if (card.style.display !== "none") visible++;
        });

        if (noResult) {
            noResult.style.display = visible === 0 ? "block" : "none";
        }
    }

    function applyFilters() {
        const keyword = search ? search.value.toLowerCase().trim() : "";
        const selectedCities = [...cityFilters]
            .filter(box => box.checked)
            .map(box => box.value.toLowerCase());
        const maxPrice = priceSlider ? Number(priceSlider.value) : Infinity;

        document.querySelectorAll(".tour-card").forEach(card => {
            const name = card.dataset.name ? card.dataset.name.toLowerCase() : "";
            const city = card.dataset.city ? card.dataset.city.toLowerCase() : "";
            const price = Number(card.dataset.price) || 0;

            const matchKeyword = keyword === "" || name.includes(keyword) || city.includes(keyword);
            const matchCity = selectedCities.length === 0 || selectedCities.includes(city);
            const matchPrice = price <= maxPrice;

            if (matchKeyword && matchCity && matchPrice) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });

        updateNoResult();
    }

    if (search) search.addEventListener("keyup", applyFilters);

    cityFilters.forEach(box => box.addEventListener("change", applyFilters));

    if (priceSlider) {
        priceSlider.addEventListener("input", () => {
            if (priceText) {
                priceText.textContent = `Up to ¥${Number(priceSlider.value).toLocaleString()}`;
            }
            applyFilters();
        });
    }

    if (sort) {
        sort.addEventListener("change", () => {
            const cards = [...document.querySelectorAll(".tour-card")];
            cards.sort((a, b) => {
                switch (sort.value) {
                    case "price-low":
                        return Number(a.dataset.price) - Number(b.dataset.price);
                    case "price-high":
                        return Number(b.dataset.price) - Number(a.dataset.price);
                    case "name":
                        return a.dataset.name.localeCompare(b.dataset.name);
                    default:
                        return 0;
                }
            });

            cards.forEach(card => grid.appendChild(card));
        });
    }

    applyFilters();
});