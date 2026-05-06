# 🔐 Smart Locker System

## 📌 Overview  
The Smart Locker System is an IoT-based secure storage solution designed to improve the safety and management of delivered packages and personal items. This system allows users to remotely control and monitor a locker using a web interface while ensuring access only to authorized users through password or One-Time Password (OTP) verification.  

It addresses the limitations of traditional lockers by providing remote access, activity tracking, and temporary access for third parties such as delivery personnel.

---

## 🎯 Aim  
To develop a **secure, cost-effective, and remotely accessible smart locker system** using IoT technology.

---

## 🎯 Objectives  
- Generate **One-Time Password (OTP)** for secure access  
- Develop a **low-cost automated locker system**  
- Enable **web-based remote access and control**  
- Maintain a **database for access logs and tracking**  
- Ensure **only authorized users** can access the locker  
- Provide a **user-friendly interface**  
- Integrate **IoT technology for real-time monitoring**

---

## ⚙️ System Architecture  

### 🔧 Hardware Components  
- ESP32 Microcontroller  
- 4×3 Keypad  
- Servo Motor  
- LED Indicators  
- Buzzer  
- Power Supply  
- Locker body (Melamine)

### 💻 Software Components  
- Frontend: HTML, CSS  
- Backend: PHP  
- Database: MySQL  
- IoT Communication via ESP32  

---

## 🔄 Working Principle  
1. User enters **password or OTP**  
2. ESP32 verifies the credentials  
3. If valid → locker unlocks (servo motor activates)  
4. If invalid → access denied  
5. All activities are **stored in the database**  
6. Locker automatically **locks after a short delay**  

---

## ✨ Features  
- 🔐 Secure access using Password & OTP  
- 🌐 Remote control via web interface  
- 📊 Activity logs and monitoring  
- 👥 Temporary access for third-party users  
- 🔄 Remote passcode change  
- ⏱ Auto-lock functionality  
- 💰 Cost-effective design  

---

## 📸 Project Outputs  
- Working **hardware prototype**  
- Functional **web interface**  
- OTP generation system (4-digit, time-limited)  
- Database logging system  

```md
