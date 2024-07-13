package com.example.demo.repositories;

import com.example.demo.models.deposit.DepositModel;
import com.example.demo.models.deposit.DepositStatus;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;

public interface IDepositRepository extends JpaRepository<DepositModel,Long> {
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d")
    Double getTotalDeposits();
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d WHERE d.date BETWEEN :startDate AND :endDate")
    Double getTotalDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d where d.status = :status")
    Double getTotalDeposits(DepositStatus status);
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d WHERE d.date BETWEEN :startDate AND :endDate and d.status = :status")
    Double getTotalDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate,DepositStatus status);

    @Query("SELECT d FROM DepositModel d WHERE d.user.codUser = :codUser ORDER BY d.date DESC")
    List<DepositModel> findAllByUserCodUserOrderByDateDesc(@Param("codUser") Long codUser);

    @Query("SELECT d FROM DepositModel d WHERE " +
            "(:externalReferenceId IS NULL OR d.codDeposit = :externalReferenceId) AND " +
            "(:codUser IS NULL OR d.user.codUser = :codUser) AND " +
            "(:status IS NULL OR d.status = :status) AND " +
            "(:fromDate IS NULL OR d.dateTime >= :fromDate) AND " +
            "(:toDate IS NULL OR d.dateTime <= :toDate) " +
            "ORDER BY d.date DESC")
    List<DepositModel> findDeposits(@Param("externalReferenceId") Long externalReferenceId,
                                    @Param("codUser") Long codUser,
                                    @Param("status") String status,
                                    @Param("fromDate") LocalDateTime fromDate,
                                    @Param("toDate") LocalDateTime toDate);

    List<DepositModel> findAllByStatusAndDateBetween(DepositStatus status, LocalDate date, LocalDate date2);
    List<DepositModel> findAllByStatus(DepositStatus status);
    List<DepositModel> findAllByOrderByDateDesc();
    List<DepositModel> findAllByDateBetween(LocalDate date, LocalDate date2);

}
