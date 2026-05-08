document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('searchForm');
    form.addEventListener('submit', handleSearch);
});

async function handleSearch(event) {
    event.preventDefault();

    // Clear previous results
    document.getElementById('resultsSection').style.display = 'none';
    document.getElementById('errorMessage').style.display = 'none';
    document.getElementById('donorsList').innerHTML = '';
    document.getElementById('noResults').style.display = 'none';

    const bloodGroup = document.getElementById('bloodGroup').value;
    const city = document.getElementById('city').value.trim();

    if (!bloodGroup) {
        showError('Please select a blood group');
        return;
    }

    // Show loading state
    const searchBtn = document.getElementById('searchText');
    const searchLoader = document.getElementById('searchLoader');
    searchLoader.style.display = 'inline-block';
    searchBtn.textContent = 'Searching...';

    try {
        let url = 'http://localhost:3000/api/donors?bloodGroup=' + encodeURIComponent(bloodGroup);
        if (city) {
            url += '&city=' + encodeURIComponent(city);
        }

        const response = await fetch(url);
        const donors = await response.json();

        if (response.ok) {
            displayResults(donors, bloodGroup, city);
        } else {
            showError('Failed to search donors. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        showError('Unable to connect to server. Please check if the server is running.');
    } finally {
        searchLoader.style.display = 'none';
        searchBtn.textContent = 'Search Donors';
    }
}

function displayResults(donors, bloodGroup, city) {
    const resultsSection = document.getElementById('resultsSection');
    const resultsTitle = document.getElementById('resultsTitle');
    const donorsList = document.getElementById('donorsList');
    const noResults = document.getElementById('noResults');

    if (donors.length === 0) {
        noResults.style.display = 'block';
        resultsTitle.textContent = 'No Results Found';
        resultsSection.style.display = 'block';
        return;
    }

    let title = `Found ${donors.length} donor${donors.length > 1 ? 's' : ''} with blood group ${bloodGroup}`;
    if (city) {
        title += ` in ${city}`;
    }
    resultsTitle.textContent = title;

    donorsList.innerHTML = '';
    donors.forEach(donor => {
        const card = createDonorCard(donor);
        donorsList.appendChild(card);
    });

    resultsSection.style.display = 'block';
    resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function createDonorCard(donor) {
    const card = document.createElement('div');
    card.className = 'donor-card';

    const header = document.createElement('div');
    header.className = 'donor-header';

    const name = document.createElement('h3');
    name.className = 'donor-name';
    name.textContent = donor.name;

    const badge = document.createElement('div');
    badge.className = 'blood-badge';
    badge.textContent = donor.bloodGroup;

    header.appendChild(name);
    header.appendChild(badge);

    const details = document.createElement('div');
    details.className = 'donor-details';

    const cityDetail = document.createElement('div');
    cityDetail.className = 'donor-detail';
    cityDetail.innerHTML = `
        <span class="icon">📍</span>
        <span class="label">City:</span>
        <span class="value">${donor.city}</span>
    `;

    const mobileDetail = document.createElement('div');
    mobileDetail.className = 'donor-detail';
    mobileDetail.innerHTML = `
        <span class="icon">📞</span>
        <span class="label">Contact:</span>
        <span class="value">${donor.mobile}</span>
    `;

    details.appendChild(cityDetail);
    details.appendChild(mobileDetail);

    const contactBtn = document.createElement('a');
    contactBtn.href = `tel:${donor.mobile}`;
    contactBtn.className = 'contact-button';
    contactBtn.textContent = `Call ${donor.mobile}`;

    card.appendChild(header);
    card.appendChild(details);
    card.appendChild(contactBtn);

    return card;
}

function showError(message) {
    const errorBox = document.getElementById('errorMessage');
    const errorText = document.getElementById('errorText');
    errorText.textContent = message;
    errorBox.style.display = 'block';
    errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

