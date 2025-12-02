function clearSearch(button) {
    const inputSelector = button.getAttribute('data-target-input');
    const baseUrl = button.getAttribute('data-base-url');

    const input = document.querySelector(inputSelector);
    if (input) input.value = '';

    window.location.href = baseUrl;
}

function startSearchLoading(input) {
    const skeletonId = input.getAttribute('data-skeleton-id') || 'loadingSkeleton';
    const tableId = input.getAttribute('data-table-id') || 'tableBody';

    const skeleton = document.getElementById(skeletonId);
    const tableBody = document.getElementById(tableId);

    if (skeleton) skeleton.classList.remove('hidden');
    if (tableBody) tableBody.classList.add('hidden');
}
