package com.example.demo.dtos.invites;

import java.util.List;

public record GetInvitesResponseDTO(
        List<InviteDTO> inviteDTOList
) {
}
