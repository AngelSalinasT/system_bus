package com.example.busbooking.models;

public class Ticket {
    String passengerName;
    String passengerEmail;
    Integer seatNumber;
    Integer scheduleId;
    Integer userId;

    public Ticket(String passengerName, String passengerEmail, Integer seatNumber, Integer scheduleId, Integer userId) {
        this.passengerName = passengerName;
        this.passengerEmail = passengerEmail;
        this.seatNumber = seatNumber;
        this.scheduleId = scheduleId;
        this.userId = userId;
    }

    public String getPassengerName() {
        return passengerName;
    }

    public void setPassengerName(String passengerName) {
        this.passengerName = passengerName;
    }

    public String getPassengerEmail() {
        return passengerEmail;
    }

    public void setPassengerEmail(String passengerEmail) {
        this.passengerEmail = passengerEmail;
    }

    public Integer getSeatNumber() {
        return seatNumber;
    }

    public void setSeatNumber(Integer seatNumber) {
        this.seatNumber = seatNumber;
    }

    public Integer getScheduleId() {
        return scheduleId;
    }

    public void setScheduleId(Integer scheduleId) {
        this.scheduleId = scheduleId;
    }

    public Integer getUserId() {
        return userId;
    }

    public void setUserId(Integer userId) {
        this.userId = userId;
    }
}
