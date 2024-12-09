package com.example.busbooking.models;

import java.sql.Time;
import java.util.Date;

public class Schedule {
    Integer routeId;
    Integer busId;
    Date date;
    Time departureTime;
    Time arrivalTime;

    public Schedule(Integer routeId, Integer busId, Date date, Time departureTime, Time arrivalTime) {
        this.routeId = routeId;
        this.busId = busId;
        this.date = date;
        this.departureTime = departureTime;
        this.arrivalTime = arrivalTime;
    }

    public Integer getRouteId() {
        return routeId;
    }

    public void setRouteId(Integer routeId) {
        this.routeId = routeId;
    }

    public Integer getBusId() {
        return busId;
    }

    public void setBusId(Integer busId) {
        this.busId = busId;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public Time getDepartureTime() {
        return departureTime;
    }

    public void setDepartureTime(Time departureTime) {
        this.departureTime = departureTime;
    }

    public Time getArrivalTime() {
        return arrivalTime;
    }

    public void setArrivalTime(Time arrivalTime) {
        this.arrivalTime = arrivalTime;
    }
}
