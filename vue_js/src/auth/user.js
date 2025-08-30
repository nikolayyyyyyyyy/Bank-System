const baseUrl = 'http://127.0.0.1:8000/api';

const login = async (obj) => {
  const response = await fetch(`${baseUrl}/login`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    body: JSON.stringify(obj)
  })

  if (!response.ok) {
    const errors = await response.json();
    throw new Error(JSON.stringify(errors));
  }
  const data = await response.json();
  localStorage.setItem('token', data.token);
}

const getUser = async () => {
  const response = await fetch(`${baseUrl}/user`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
    }
  });

  const data = await response.json();
  return data.name;
};

export function auth() {
  return {
    login,
    getUser
  };
}