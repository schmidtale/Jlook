document.addEventListener("DOMContentLoaded", () => {

    if (typeof tours === "undefined" || tours.length < 3) return;

    // Featured Card
    const featuredImage = document.getElementById("featuredImage");
    const featuredTitle = document.getElementById("featuredTitle");
    const featuredDesc = document.getElementById("featuredDesc");

    // Small Cards
    const smallImage1 = document.getElementById("smallImage1");
    const smallImage2 = document.getElementById("smallImage2");

    const smallCard1 = smallImage1.closest(".small-card");
    const smallCard2 = smallImage2.closest(".small-card");

    // Buttons
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");

    // Counter
    const counter = document.querySelector(".slider-count");

    let current = 0;

    function updateHero() {

        const total = tours.length;

        const featured = tours[current % total];
        const small1 = tours[(current + 1) % total];
        const small2 = tours[(current + 2) % total];

        // ===== Featured =====
        featuredImage.src = "assets/images/" + featured.image;
        featuredImage.alt = featured.name;

        featuredTitle.textContent = featured.name;

        featuredDesc.textContent =
            featured.description.length > 120
                ? featured.description.substring(0, 120) + "..."
                : featured.description;

        // ===== Small Card 1 =====
        smallImage1.src = "assets/images/" + small1.image;
        smallImage1.alt = small1.name;

        // ===== Small Card 2 =====
        smallImage2.src = "assets/images/" + small2.image;
        smallImage2.alt = small2.name;

        // ===== Counter =====
        if (counter) {

            counter.textContent =
                `${String(current + 1).padStart(2, "0")}/${String(total).padStart(2, "0")}`;

        }

    }

    // ==========================
    // Next Button
    // ==========================
    nextBtn.addEventListener("click", () => {

        current = (current + 1) % tours.length;

        updateHero();

    });

    // ==========================
    // Previous Button
    // ==========================
    prevBtn.addEventListener("click", () => {

        current = (current - 1 + tours.length) % tours.length;

        updateHero();

    });

    // ==========================
    // Click Small Card 1
    // ==========================
    smallCard1.addEventListener("click", () => {

        current = (current + 1) % tours.length;

        updateHero();

    });

    // ==========================
    // Click Small Card 2
    // ==========================
    smallCard2.addEventListener("click", () => {

        current = (current + 2) % tours.length;

        updateHero();

    });

    // First Load
    updateHero();

});