document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("logout");

    logoutButton.addEventListener("click", function (event) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('logout') }}",
                    type: "get",
                    success: function (response) {
                        window.location.href = "/";
                    },
                });
            }
        });
    });
});
