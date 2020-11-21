class Modal {
  constructor(modalId) {
    this.id = modalId;
    this.modal = document.getElementById(modalId);
    this.modalBg = this.modal.querySelector(".modal-background");
    this.modalBtn = document.querySelector(`button[data-ref=${modalId}]`);
    this.modalCloseBtn = this.modal.querySelector(".modal-close");

    this.modalBtn.addEventListener("click", () => this.openModal());
    this.modalBg.addEventListener("click", () => this.closeModal());
    this.modalCloseBtn.addEventListener("click", () => this.closeModal());
  }

  openModal() {
    this.modal.classList.add("is-active");
  }

  closeModal() {
    this.modal.classList.remove("is-active");
  }
}
