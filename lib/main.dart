import 'package:flutter/material.dart';
//import 'package:neatzy/view/home.dart';
//import 'package:neatzy/view/login.dart';
import 'package:neatzy/view/register.dart';
//
void main() => runApp(MyApp());

class MyApp extends StatelessWidget{
  const MyApp ({super.key});
  // root
  @override
  Widget build(BuildContext context){
    return MaterialApp(
      title: 'Latihan Flutter',
      home: RegisterPage(),
    );
  }
}