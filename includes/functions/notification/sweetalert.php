<?php



function swal($title, $text = '', $icon = null, $buttonText = 'OK', $redirectUrl = null)
{
    // Start building the JS config
    $swalConfig = [
        'title' => $title,
        'text' => $text,
        'confirmButtonText' => $buttonText
    ];

    // Only include icon if it's not empty
    if (!empty($icon)) {
        $swalConfig['icon'] = $icon;
    }

    // Convert the PHP array to a JS object
    $jsConfig = json_encode($swalConfig);

    // Start the JavaScript to show SweetAlert2
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire($jsConfig).then((result) => {
                // Check if a redirection URL is provided
                if ('$redirectUrl' !== '') {
                    window.location.href = '$redirectUrl';
                }
            });
        });
    </script>
    ";
}

