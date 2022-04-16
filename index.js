const express = require('express')
const app = express()
const path = require('path');
const expressLayout = require('express-ejs-layouts');
const fs = require("fs");



//menggunakan EJS
app.set('view engine','ejs');

app.use(expressLayout)

app.get('/', (req, res) => {
  res.send('Hello World!');
});


app.get('/post',(req,res) => {
  let fileBuffer = fs.readFileSync('data/note.json');
  const noteObject = JSON.parse(fileBuffer);
  let submitButton = req.query.submit;
  if(submitButton != null){

    let noteTitle = req.query.noteTitle;
    let noteContent = req.query.noteContent;
    let data = {
      title:noteTitle,
      content:noteContent
    };
    noteObject.push(data)
    fs.writeFileSync("data/note.json",JSON.stringify(noteObject));
    console.log("Done writting")
    console.log(noteObject)
  }
  res.render('post',{
    title:'ini adalah halaman post',
    layout:'layouts/main-layouts',
    data:noteObject
  });
})

app.get('/about',(req,res) => {
  let tentang = req.params.tentang
  res.render('about',{
    title:'About',
    tentang,
    layout:'layouts/main-layouts'
  })
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
    dataSiswa:dataSiswa,
    layout:'layouts/main-layouts',
    title:'ini adalah home'
  });
  // res.json(dataSiswa)
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

app.get('/note',(req,res)=>{
  let file = fs.readFileSync('data/note.json')
  let noteObj = JSON.parse(file);
  console.log(noteObj);
  res.render('note',{
    noteData:noteObj,
    title:'Note',
    layout:'layouts/main-layouts'
  })
})

// anggap saja error handler
app.use('/',(req,res) => {
  res.status(404)
  res.send("Halaman tidak ada")
})

const port = process.env.PORT || 8000;
app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
  // console.log(app);
}) 