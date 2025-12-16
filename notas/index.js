// index.js (Cloud Function)
const functions = require('firebase-functions');
const admin = require('firebase-admin');
const express = require('express');
const cors = require('cors');

admin.initializeApp();

const app = express();
app.use(cors({ origin: true }));

app.get('/getFirebaseData', async (req, res) => {
  try {
    const snapshot = await admin.database().ref('users/alanisawesome').once('value');
    const data = snapshot.val();
    res.json(data);
  } catch (error) {
    console.error('Error al obtener los datos:', error);
    res.status(500).send('Error interno del servidor');
  }
});

exports.getFirebaseData = functions.https.onRequest(app);
