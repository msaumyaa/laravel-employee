// $("#file").change(function () {
$(document).on("change", "#file", function () {
    readURL(this);
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#logo").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function handleDelete(id, $employee) {
    var form = document.getElementById("deleteForm");
    form.action = "/" + $employee + "/" + id;
    $("#deleteModal").modal("show");
}
