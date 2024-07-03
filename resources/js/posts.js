<script>
    document.getElementById('selectButton').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('.delete-checkbox-container');
    checkboxes.forEach(function(checkbox) {
    checkbox.style.display = 'flex'; // or 'block' depending on your CSS
});

    document.getElementById('deleteButton').style.display = 'inline-block';
    this.style.display = 'none';
});
</script>
