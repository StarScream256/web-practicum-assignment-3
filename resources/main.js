const registrationForm = document.querySelector("#registrationForm");

registrationForm.addEventListener("submit", async (e) => {
  const formData = new FormData(e.target);
  if (!registrationForm.checkValidity()) {
    e.preventDefault();
    if (!formData.get("name")) alert("Namas wajib diisi");
    else if (!formData.get("email")) alert("Email wajib diisi");
  } else {
    registrationForm.classList.add("was-validated");
    const response = await fetch("data.json");
    const data = await response.json();

    const getPackageName = (id) => {
      return data.packages.filter((package) => {
        return package.id == id;
      })[0].name;
    };

    const name = formData.get("name");
    let package = formData.get("packages");
    package = package ? getPackageName(package) : "Belum memilih";

    const isConfirm = confirm(
      `Halo, ${name}. Anda memilih paket bimbel: ${package}.\nApakah Anda yakin ingin melanjutkan?`
    );
    console.log(isConfirm);
    if (isConfirm) registrationForm.submit();
    else alert("Pesanan dibatalkan");
  }
});
