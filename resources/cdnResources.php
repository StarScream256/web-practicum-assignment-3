<!-- Tailwind CSS -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
  rel="stylesheet" />

<!-- Google Fonts Icon -->
<link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back,book,check,delete,edit,person,person_add,star_shine,visibility,warning" />

<!-- DataTables -->
<link
  href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.3.4/b-3.2.5/b-colvis-3.2.5/b-print-3.2.5/fc-5.0.5/r-3.0.7/sb-1.8.4/sp-2.3.5/datatables.min.css"
  rel="stylesheet" integrity="sha384-ky+A/TyfB612VHwJLRnXTHmYX33fNFscBZYLbi+wHmbCPjXf/aQIjitNnTVnSPOu"
  crossorigin="anonymous">
<script
  src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.3.4/b-3.2.5/b-colvis-3.2.5/b-print-3.2.5/fc-5.0.5/r-3.0.7/sb-1.8.4/sp-2.3.5/datatables.min.js"
  integrity="sha384-w0EI8TEWuGRAm18hNP7dYQcnm3DEt9+CRqp2COfHvrMSqUwI3dV8ivDsFubORWn9" crossorigin="anonymous"></script>

<style>
  p {
    margin-bottom: 0px !important;
  }

  .pricing-card {
    cursor: pointer;
  }

  .discounted-price {
    text-decoration: line-through;
  }

  label:has(input[type="radio"]:checked) {
    outline: 2px solid blue;
  }

  .ubuntu-light {
    font-family: "Ubuntu", sans-serif;
    font-weight: 300;
    font-style: normal;
  }

  .ubuntu-regular {
    font-family: "Ubuntu", sans-serif;
    font-weight: 400;
    font-style: normal;
  }

  .ubuntu-medium {
    font-family: "Ubuntu", sans-serif;
    font-weight: 500;
    font-style: normal;
  }

  .ubuntu-bold {
    font-family: "Ubuntu", sans-serif;
    font-weight: 700;
    font-style: normal;
  }

  .ubuntu-light-italic {
    font-family: "Ubuntu", sans-serif;
    font-weight: 300;
    font-style: italic;
  }

  .ubuntu-regular-italic {
    font-family: "Ubuntu", sans-serif;
    font-weight: 400;
    font-style: italic;
  }

  .ubuntu-medium-italic {
    font-family: "Ubuntu", sans-serif;
    font-weight: 500;
    font-style: italic;
  }

  .ubuntu-bold-italic {
    font-family: "Ubuntu", sans-serif;
    font-weight: 700;
    font-style: italic;
  }

  .jetbrains-mono-regular {
    font-family: "JetBrains Mono", monospace;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: normal;
  }
</style>