import "./icons";

document.addEventListener("DOMContentLoaded", () => {
    // -------------------------
    // TOAST
    // -------------------------
    /*
    document.querySelectorAll("[data-toast]").forEach((toast) => {
        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-10px)";
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    });
*/
    // -------------------------
    // IMAGES DYNAMIC
    // -------------------------
    const btn = document.getElementById("add-image-btn");
    const wrapper = document.getElementById("images-wrapper");

    if (!btn || !wrapper) return;

    let index = wrapper.querySelectorAll(".image-row").length;

    btn.addEventListener("click", () => {
        wrapper.insertAdjacentHTML(
            "beforeend",
            `
            <div class="image-row mb-2">
                <input type="text" name="images[${index}][url]" class="form-control mb-2" placeholder="URL imagen">

                <select name="images[${index}][type]" class="form-control mb-2">
                    <option value="main">Principal</option>
                    <option value="secondary">Secundaria</option>
                </select>
            </div>
        `,
        );

        index++;
    });
});
