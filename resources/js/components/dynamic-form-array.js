import { createIcons, icons } from "lucide";

document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("multimedia-container");
  const addButton = document.getElementById("add-multimedia");
  let rowCount = 0;

  function createRow() {
    const index = rowCount++;
    const row = document.createElement("div");
    row.className = "multimedia-row";
    row.style.cssText =
      "display: flex; flex-direction: row; align-items: center; gap: 15px; padding: 10px 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; transition: all 0.3s ease; animation: slideIn 0.3s ease-out; min-width: 0;";

    row.innerHTML = `
            <!-- PARTE IZQUIERDA: SELECCIÓN DE ARCHIVO -->
            <div style="flex: 1; display: flex; align-items: center; gap: 12px; min-width: 0;">
                <label class="stroke-button info" style="cursor: pointer; padding: 8px 14px; font-size: 12px; display: inline-flex; align-items: center; gap: 8px; border-radius: 8px; margin: 0; white-space: nowrap; flex-shrink: 0; height: 38px;">
                    <i data-lucide="upload" style="width: 18px; height: 18px;"></i>
                    <span style="font-weight: 600;">Seleccionar archivo</span>
                    <input type="file" name="multimedia[${index}][file]" required style="display: none;" class="file-input">
                </label>
                <span class="file-name" style="font-size: 11px; color: #94a3b8; font-weight: 500; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; flex: 1;">Ningún archivo</span>
            </div>

            <!-- PARTE CENTRAL: TIPO DE ARCHIVO -->
            <div style="display: flex; gap: 15px; background: white; padding: 0 15px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.05); flex-shrink: 0; height: 38px; align-items: center;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 11px; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">
                    <input type="radio" name="multimedia[${index}][type]" value="image" checked style="accent-color: #3b82f6; width: 16px; height: 16px;"> 
                    <span>Imagen</span>
                </label>
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 11px; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">
                    <input type="radio" name="multimedia[${index}][type]" value="3d_model" style="accent-color: #3b82f6; width: 16px; height: 16px;"> 
                    <span>Modelo 3D</span>
                </label>
            </div>

            <!-- PARTE DERECHA: ELIMINAR -->
            <button type="button" class="stroke-button danger remove-multimedia" style="padding: 0; border-radius: 8px; display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; flex-shrink: 0; margin: 0;">
                <i data-lucide="trash-2"></i>
            </button>
        `;

    createIcons({
      icons,
      root: row,
    });

    const fileInput = row.querySelector(".file-input");
    const fileNameSpan = row.querySelector(".file-name");
    fileInput.addEventListener("change", (e) => {
      const fileName = e.target.files[0]
        ? e.target.files[0].name
        : "Ningún archivo";
      fileNameSpan.textContent = fileName;
      fileNameSpan.style.color = e.target.files[0] ? "#3b82f6" : "#94a3b8";
      fileNameSpan.style.fontWeight = e.target.files[0] ? "600" : "500";
    });

    const removeBtn = row.querySelector(".remove-multimedia");
    removeBtn.addEventListener("click", () => {
      row.style.opacity = "0";
      row.style.transform = "scale(0.95)";
      setTimeout(() => {
        row.remove();
        if (container.children.length === 0) {
          rowCount = 0;
        }
      }, 300);
    });

    return row;
  }

  if (addButton && container) {
    addButton.addEventListener("click", () => {
      container.appendChild(createRow());
    });
  }
});

const style = document.createElement("style");
style.textContent = `
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .remove-multimedia svg {
        margin-right: 0 !important;
        width: 18px !important;
        height: 18px !important;
        display: block !important;
    }
`;
document.head.appendChild(style);
