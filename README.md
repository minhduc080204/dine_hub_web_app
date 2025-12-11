# 🍽️ Dine Hub Web App

A full-stack, cross-platform **food ordering and management system** for **Web, iOS, and Android**, built with **Laravel**, **React Native**, **Docker**, **MySQL**, and a **Python Flask Recommendation Engine**.

## 📚 Live Demo & Repository
- **Repository:** https://github.com/minhduc080204/dine_hub_web_app  
- **Figma UI:** https://www.figma.com/design/Kh2GvebWmmLc8jRs3e1NRB/DineHub--Restaurant-Food-Delivery-Figma-UI-Template

---

## 🚀 Project Overview

Dine Hub provides a seamless multi-platform experience for food browsing, ordering, and store management.  
Users can browse menu items, place orders, and track delivery, while administrators manage products, orders, and analytics.

The system follows a clean Client–Server architecture, includes secure Laravel APIs, real-time messaging through Pusher, and a standalone Python-based recommendation engine for personalization.

---

## 🧱 Key Features

### 🔹 Consumer App (React Native)
- Browse products by categories  
- Search and filter  
- Cart management & checkout  
- User profile & order history  
- Personalized product recommendations (Flask Recommender)

### 🔹 Admin Dashboard (Laravel Blade + API)
- Product CRUD  
- Real-time order management  
- User management  
- Analytics & reporting dashboard  

### 🔹 Shared Core Features
- **Authentication & Authorization** using Laravel Sanctum  
- **RESTful APIs** for client–server communication  
- **Real-time notifications & chat** via Pusher + Laravel Echo  
- **Dockerized** architecture for development and deployment  

---

## ⭐ Recommendation System (Python Flask)

A standalone microservice built with **Flask**, integrated into the main application to enhance user personalization through intelligent recommendations.

**Capabilities:**
- Recommends products based on shopping behavior and order history  
- Communicates with Laravel backend via REST APIs  
- Integrated with React Native and Web clients  
- Modular design for easy ML model updates or upgrades  

This recommender system was independently researched and implemented as part of a post-internship improvement initiative.

---

## 🛠️ Tech Stack

| Layer               | Technologies |
|---------------------|--------------|
| **Backend**         | Laravel, PHP, MySQL |
| **Mobile App**      | React Native |
| **Web Frontend**    | Laravel Blade, Tailwind CSS |
| **Recommender**     | Python Flask |
| **DevOps**          | Docker, Docker Compose |
| **Real-time**       | Pusher, Laravel Echo |

---

## 🏗️ Architecture Overview
- Cross-platform ecosystem (Web + iOS + Android)  
- Secure REST API layer for synchronization  
- Real-time chat & notifications  
- Independent Flask microservice for recommendations  
- Fully containerized infrastructure  

