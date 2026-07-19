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


    document.getElementById('bookingModal').classList.add('active');
}


function closeBookingModal() {
    document.getElementById('bookingModal').classList.remove('active');
}


function calculateTotalPrice() {
    const guestsCount = parseInt(document.getElementById('bookingGuests').value);
    const totalPrice = currentTourPrice * guestsCount;
    
    
    document.getElementById('modalTotalPrice').innerText = '¥' + totalPrice.toLocaleString();
}

window.onclick = function(event) {
    const modal = document.getElementById('bookingModal');
    if (event.target === modal) {
        closeBookingModal();
    }
}


document.addEventListener("DOMContentLoaded", () => {

    // ===============================
    // Check Data
    // ===============================
    if (typeof tours === "undefined" || tours.length < 3) return;

    // ===============================
    // Hero Elements
    // ===============================
    const featuredImage = document.getElementById("featuredImage");
    const featuredTitle = document.getElementById("featuredTitle");
    const featuredDesc = document.getElementById("featuredDesc");

    const smallImage1 = document.getElementById("smallImage1");
    const smallImage2 = document.getElementById("smallImage2");

    const smallTitle1 = document.getElementById("smallTitle1");
    const smallTitle2 = document.getElementById("smallTitle2");

    const smallCard1 = smallImage1.closest(".small-card");
    const smallCard2 = smallImage2.closest(".small-card");

    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");

    const counter = document.querySelector(".slider-count");

    let current = 0;

    // ===============================
    // Update Hero
    // ===============================
    function updateHero() {
        const total = tours.length;
        const featured = tours[current];
        const small1 = tours[(current + 1) % total];
        const small2 = tours[(current + 2) % total];

        // Featured
        featuredImage.src = "assets/images/" + featured.image;
        featuredImage.alt = featured.name;
        featuredTitle.textContent = featured.name;

        featuredDesc.textContent =
            featured.description.length > 120
                ? featured.description.substring(0, 120) + "..."
                : featured.description;

        // Small 1
        smallImage1.src = "assets/images/" + small1.image;
        smallImage1.alt = small1.name;
        smallTitle1.textContent = small1.name;

        // Small 2
        smallImage2.src = "assets/images/" + small2.image;
        smallImage2.alt = small2.name;
        smallTitle2.textContent = small2.name;

        // Counter
        if (counter) {
            counter.textContent =
                `${String(current + 1).padStart(2, "0")}/${String(total).padStart(2, "0")}`;
        }
    }

    // ===============================
    // Next
    // ===============================
    nextBtn.addEventListener("click", () => {
        current = (current + 1) % tours.length;
        updateHero();
    });

    // ===============================
    // Previous
    // ===============================
    prevBtn.addEventListener("click", () => {
        current = (current - 1 + tours.length) % tours.length;
        updateHero();
    });

    // ===============================
    // Click Small Card 1
    // ===============================
    smallCard1.addEventListener("click", () => {
        current = (current + 1) % tours.length;
        updateHero();
    });

    // ===============================
    // Click Small Card 2
    // ===============================
    smallCard2.addEventListener("click", () => {
        current = (current + 2) % tours.length;
        updateHero();
    });

    // First Load
    updateHero();

    // ===================================================
    // Live Search
    // ===================================================
    const searchInput = document.getElementById("searchTour");
    const suggestion = document.getElementById("searchSuggestion");

    if (searchInput && suggestion) {
        searchInput.addEventListener("keyup", () => {
            const keyword = searchInput.value.toLowerCase().trim();
            suggestion.innerHTML = "";

            if (keyword === "") {
                suggestion.style.display = "none";
                return;
            }

            const result = tours.filter(tour =>
                (tour.name ?? "").toLowerCase().includes(keyword) ||
                (tour.city ?? "").toLowerCase().includes(keyword)
            );

            if (result.length === 0) {
                suggestion.style.display = "none";
                return;
            }

            suggestion.style.display = "block";

            result.forEach(tour => {
                const item = document.createElement("div");
                item.innerHTML = `
                    📍 <strong>${tour.name}</strong><br>
                    <small>${tour.city}</small>
                `;

                item.onclick = () => {
                    searchInput.value = tour.name;
                    suggestion.style.display = "none";
                    searchInput.focus();
                };

                suggestion.appendChild(item);
            });
        });

        // Hide suggestion when click outside
        document.addEventListener("click", (e) => {
            if (!e.target.closest(".search-input-group")) {
                suggestion.style.display = "none";
            }
        });
    }

});