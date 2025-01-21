window.renderClients = async function fetchRequest(url, method = 'GET', body = null, headers = {}) {
    try {
        const defaultHeaders = {
            'Content-Type': 'application/json',
        };

        const response = await fetch(url, {
            method: method,
            headers: { ...defaultHeaders, ...headers },
            body: body ? JSON.stringify(body) : null,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Fetch error:', error);
        throw error;
    }
}
