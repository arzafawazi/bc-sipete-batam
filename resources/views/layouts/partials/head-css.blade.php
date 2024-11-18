@yield('css')
@vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
  body {
    opacity: 0;
    transition: opacity 0.1s ease;
  }

  /* Menyesuaikan Select2 dengan bootstrap */
  /* Select2 Bootstrap Integration Styles */

  /* Base container styling */
  .select2-container {
    width: 100% !important;

  }

  /* Single selection styling */
  .select2-container .select2-selection--single {
    height: calc(2.25rem + 2px) !important;
    padding: .375rem .75rem !important;
    border-radius: .375rem !important;
    border: 1px solid #ced4da !important;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
  }

  .select2-container .select2-selection--single:focus {
    border-color: #80bdff !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    outline: 0 !important;
  }

  /* Selection text rendering */
  .select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 1.5 !important;
    padding-left: 0 !important;
    color: #495057 !important;
  }

  /* Multiple selection styling */
  .select2-container--default .select2-selection--multiple {
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 4px !important;
    min-height: calc(2.25rem + 2px) !important;
    padding: 0.25rem !important;
    align-items: center !important;
    background-color: #fff !important;
    border: 1px solid #ced4da !important;
    border-radius: 0.375rem !important;
  }

  /* Multiple selection choices */
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #287f71 !important;
    color: white !important;
    padding: 4px 28px 4px 15px !important;
    margin: 2px 4px !important;
    border-radius: .25rem !important;
    font-size: 0.875rem !important;
    display: flex !important;
    align-items: center !important;
    border: none !important;
    position: relative !important;
    transition: background-color 0.2s ease !important;
    display: inline-flex !important;
    border: none !important;
    max-width: calc(100% - 8px) !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
  }

  /* Choice remove button */
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    position: relative !important;
    border: 0 !important;
    padding: 0 4px !important;
    margin-right: 4px !important;
    color: rgba(255, 255, 255, 0.8) !important;
    font-size: 1rem !important;
    font-weight: bold !important;
    cursor: pointer !important;
    background: transparent !important;
    border-radius: 2px !important;
  }

  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: white !important;
    background-color: rgba(255, 255, 255, 0.1) !important;
  }

  /* Dropdown styling */
  .select2-dropdown {
    border: 1px solid #ced4da !important;
    border-radius: .375rem !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    background-color: white !important;
    z-index: 1056 !important;
    /* Above Bootstrap modals */
  }

  /* Search field styling */
  .select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid #ced4da !important;
    border-radius: .25rem !important;
    padding: .375rem .75rem !important;
  }

  .select2-container--default .select2-search--dropdown .select2-search__field:focus {
    border-color: #80bdff !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
    outline: 0 !important;
  }

  /* Results styling */
  .select2-results__option {
    padding: .375rem .75rem !important;
    font-size: 0.875rem !important;
  }

  .select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #287f71 !important;
    color: white !important;
  }

  /* Disabled state */
  .select2-container--default.select2-container--disabled .select2-selection--single,
  .select2-container--default.select2-container--disabled .select2-selection--multiple {
    background-color: #e9ecef !important;
    cursor: not-allowed !important;
  }

  /* Placeholder styling */
  .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d !important;
  }

  /* Clear selection button */
  .select2-container--default .select2-selection--single .select2-selection__clear {
    color: #6c757d !important;
    margin-right: 8px !important;
    font-weight: bold !important;
  }

  /* Loading state */
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    right: 8px !important;
  }
</style>
