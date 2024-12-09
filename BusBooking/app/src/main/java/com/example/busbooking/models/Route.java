package com.example.busbooking.models;

public class Route {
    String routeName;
    String origin;
    String destination;
    Integer distance;
    Integer estimetedTime;
    Integer branchId;

    public Route(String routeName, String origin, String destination, Integer distance, Integer estimetedTime, Integer branchId) {
        this.routeName = routeName;
        this.origin = origin;
        this.destination = destination;
        this.distance = distance;
        this.estimetedTime = estimetedTime;
        this.branchId = branchId;
    }

    public String getRouteName() {
        return routeName;
    }

    public void setRouteName(String routeName) {
        this.routeName = routeName;
    }

    public String getOrigin() {
        return origin;
    }

    public void setOrigin(String origin) {
        this.origin = origin;
    }

    public String getDestination() {
        return destination;
    }

    public void setDestination(String destination) {
        this.destination = destination;
    }

    public Integer getDistance() {
        return distance;
    }

    public void setDistance(Integer distance) {
        this.distance = distance;
    }

    public Integer getEstimetedTime() {
        return estimetedTime;
    }

    public void setEstimetedTime(Integer estimetedTime) {
        this.estimetedTime = estimetedTime;
    }

    public Integer getBranchId() {
        return branchId;
    }

    public void setBranchId(Integer branchId) {
        this.branchId = branchId;
    }
}
