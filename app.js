const express = require('express')
const app = express()
const port = 3000

//menggunakan EJS
app.set('view engine','ejs');

app.get('/', (req, res) => {
  res.send('Hello World!');
});

app.get('/about',(req,res) => {
  res.send('ini adalah halaman about');
})         

app.get('/post',(req,res) => {
  let jumlah = req.query.jumlah
  // res.send("ini adalah halaman post")
  res.render('post',{jumlah:jumlah});
})

app.get('/home',(req,res)=>{
  const dataSiswa = [
    {
      nama:"Alpha",
      kelas:"XII-SIJA",
      noAbsen:1
    },
    {
      nama:"Bravo",
      kelas:"XII-SIJA",
      noAbsen:2
    },
    {
      nama:"Charlie",
      kelas:"XII-SIJA",
      noAbsen:3
    },
  ]
  // res.sendFile('./index.html',{root: __dirname})
  res.render('index',{
    dataSiswa:dataSiswa
  });
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