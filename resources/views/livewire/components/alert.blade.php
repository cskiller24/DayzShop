<div id="alert-con">
</div>

@script
<script>
    Livewire.on('flash-alert', (event) => {
        let message = event.message;
        let type = event?.type ?? 'error';
        flashAlert(message, type);
    });

    Livewire.on('flash-reset', (event) => {
        flashReset();
    });

    function flashReset() {
        document.getElementById('alert-con').innerHTML = "";
    }

    function flashAlert(msg, type = 'error') {
        if (!['success', 'warning', 'info', 'danger', 'error'].includes(type)) {
            throw new Error(`Type ${type} does not include on approved toast. WARNING, INFO, DANGER, ERROR, SUCCESS`);
        }

        if (type === 'success') {
            let success = `
            <div class="alert alert-important bg-danger-lt alert-dismissible" role="alert" id="alert">
            <div class="d-flex">
              <div class="me-1">
                <i class="ti ti-alert-circle icon"></i>
              </div>
              <div id="error-msg" class="error-msg">
                ${msg}
              </div>
            </div>
            <a class="btn-close btn-close-gray" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            `
            document.getElementById('alert-con').insertAdjacentHTML('beforeend', success);

            return;
        }

        if (type === 'error') {
            let error = `
          <div class="alert alert-important bg-danger-lt alert-dismissible" role="alert" id="alert">
            <div class="d-flex">
              <div class="me-1">
                <i class="ti ti-alert-circle icon"></i>
              </div>
              <div id="error-msg" class="error-msg">
                ${msg}
              </div>
            </div>
            <a class="btn-close btn-close-gray" data-bs-dismiss="alert" aria-label="close"></a>
          </div>`;
            document.getElementById('alert-con').insertAdjacentHTML('beforeend', error);
            return
        }

        if (type === 'danger') {
            let danger = `
      <div class="alert alert-important bg-danger-lt alert-dismissible" role="alert" id="alert">
        <div class="d-flex">
          <div class="me-1">
              <i class="ti ti-alert-circle icon"></i>
          </div>
          <div id="error-msg" class="error-msg">
            ${msg}
          </div>
        </div>
        <a class="btn-close btn-close-gray" data-bs-dismiss="alert" aria-label="close"></a>
      </div>
      `
            document.getElementById('alert-con').insertAdjacentHTML('beforeend', danger);
            return
        }

        if (type === 'warning') {
            let warning = `
              <div class="alert alert-important bg-warning-lt alert-dismissible" role="alert">
                <div class="d-flex">
                  <div class="me-1">
                    <i class="ti ti-alert-triangle"></i>
                  </div>
                  <div>
                    ${msg}
                  </div>
                </div>
                <a class="btn-close btn-close-gray" data-bs-dismiss="alert" aria-label="close"></a>
              </div>
            `
            document.getElementById('alert-con').insertAdjacentHTML('beforeend', warning);

            return
        }

        if (type === 'info') {
            let info = `
              <div class="alert alert-important bg-blue-lt alert-dismissible" role="alert">
                <div class="d-flex">
                  <div class="me-1">
                    <i class="ti ti-info-circle"></i>
                  </div>
                  <div>
                    ${msg}
                  </div>
                </div>
                <a class="btn-close btn-close-gray" data-bs-dismiss="alert" aria-label="close"></a>
              </div>`
            document.getElementById('alert-con').insertAdjacentHTML('beforeend', info);

            return;
        }
    }
</script>
@endscript
