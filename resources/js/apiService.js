// apiService.js
const API_BASE_URL = '/api';

export async function fetchCreatures(query = '') {
  const response = await fetch(`${API_BASE_URL}/creatures?search=${encodeURIComponent(query)}`);
  if (!response.ok) throw new Error('Errore nella chiamata API');
  return response.json();
}

export async function fetchDeities(query = '') {
  const response = await fetch(`${API_BASE_URL}/deities?search=${encodeURIComponent(query)}`);
  if (!response.ok) throw new Error('Errore nella chiamata API');
  return response.json();
}
