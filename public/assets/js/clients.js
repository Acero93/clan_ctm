

async function fetchRequest(url, method = 'GET', body = null, headers = {}) {
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json',
            ...headers,
        },
        body: body ? JSON.stringify(body) : null,
    };
    const response = await fetch(url, options);
    return response.json();
}
