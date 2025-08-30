const baseUrl = 'http://127.0.0.1:8000/api';

const createTransaction = async (transaction) => {
  const response = await fetch(`${baseUrl}/transactions`, {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    },
    body: JSON.stringify(transaction)
  })

  if (!response.ok) {
    const errors = await response.json();
    throw new Error(JSON.stringify(errors));
  }
  return 'Успешно създадена транзакция.';
};

export function transaction() {
  return {
    createTransaction
  }
}