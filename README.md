# Event Booking API

## Overview
This API provides functionality for managing events, attendees, and bookings. It allows users to create events, register attendees, and book events while handling overbooking and duplicate bookings.


## Module Installation

1. **Install the module**:
   - Copy the module to `app/code/Vendor/EventBooking`
   - Run the following commands to install:
     ```bash
     php bin/magento setup:upgrade
     php bin/magento setup:di:compile
     php bin/magento cache:flush
     ```

2. **Check Module Status**:
   - Ensure that the module is enabled:
     ```bash
     php bin/magento module:status Vendor_EventBooking
     ```

## API Endpoints

### 1. **Create Event**
   - **URL**: `/rest/V1/events`
   - **Method**: `POST`
   - **Request Body**:
     ```json
     {
       "name": "Sample Event",
       "description": "Event description",
       "date": "2025-06-15 10:00:00",
       "location": "USA",
       "capacity": 100
     }
     ```
   - **Response**:
     ```json
     {
       "success": true,
       "event_id": 1
     }
     ```

### 2. **List Events**
   - **URL**: `/rest/V1/events`
   - **Method**: `GET`
   - **Response**:
     ```json
     [
       {
         "event_id": 1,
         "name": "Sample Event",
         "description": "Event description",
         "date": "2025-06-15 10:00:00",
         "location": "USA",
         "capacity": 100
       }
     ]
     ```

### 3. **Book Event**
   - **URL**: `/rest/V1/events/{eventId}/book`
   - **Method**: `POST`
   - **Request Body**:
     ```json
     {
       "full_name": "John Doe",
       "email": "john.doe@example.com",
       "phone_number": "1234567890",
       "address": "New York, USA"
     }
     ```
   - **Response**:
     ```json
     {
       "success": true,
       "booking_id": 1
     }
     ```

## Features
- Prevents overbooking of events.
- Ensures duplicate bookings for the same attendee are not allowed.
- API is structured for ease of expansion and maintenance.

## Testing

Run unit tests to verify functionality:
```bash
php bin/magento dev:tests:run
