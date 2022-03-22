const express = require('express')
const app = express()
const port = 3000

app.get('/', (req, res) => {
  res.send('Hello World!');
});

app.get('/about',(req,res) => {
  res.send('ini adalah halaman about');
})

app.get('/post',(req,res) => {
  res.send("ini adalah halaman post")
})

app.get('/home',(req,res)=>{
  res.sendFile('./index.html',{root: __dirname})
})

app.get('/post/:id/:cat',(req,res ) => {
  res.send(`Post ID: ${req.params.id}<br>CatID:${req.params.cat}`)
  console.log(req.params)
});

app.get('/query',(req,res) => {
  let q = req.query.q;
  res.send(`Isi Query adalah: ${q}`);
  console.log(req.query);
});

app.get('/api',(req,res)=>{
  res.json({
    nama: 'Ainurahman',
    kelas: 'XII-SIJA'
  });
})

// anggap saja error handler
app.use('/',(req,res) => {
  res.status(404)
  res.send("Halaman tidak ada")
})

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
  // console.log(app);
}) 